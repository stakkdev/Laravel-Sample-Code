<?php

namespace App\Services\API\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\API\V1\OtpHelper;
use App\Helpers\API\V1\AuthHelper;

use App\Enums\API\V1\Auth\LoginType;
use App\Enums\API\V1\Auth\VerifyType;
use App\Enums\API\V1\Auth\SendOtpType;
use App\Enums\API\V1\Auth\VerifyStatus;

use App\Traits\API\V1\Common\SendOTP;

use App\Exceptions\API\V1\SuccessException;
use App\Exceptions\API\V1\SomeThingWentWrong;
use App\Exceptions\API\V1\BadRequestException;
use App\Http\Resources\API\V1\Auth\AuthResource;

use App\Http\Requests\API\V1\Auth\AuthLoginRequest;
use App\Http\Requests\API\V1\Auth\ImageUploadRequest;
use App\Http\Requests\API\V1\Auth\AuthRegisterRequest;

use App\Services\API\V1\Interfaces\Auth\IAuthService;
use App\Repositories\API\V1\Interfaces\Auth\IOtpRepository;
use App\Repositories\API\V1\Interfaces\Auth\IAuthRepository;


class AuthService implements IAuthService
{
	use SendOTP;

	private $iOtpRepository;
	private $iAuthRepository;

	public function __construct(IAuthRepository $iAuthRepository, IOtpRepository $iOtpRepository)
	{
		$this->iOtpRepository = $iOtpRepository;
		$this->iAuthRepository = $iAuthRepository;
	}
	
	/**
	 * login
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function login(AuthLoginRequest $request)
	{
		$data = AuthHelper::get_login_request_data($request);

		switch ($data['login_type']) {
			case LoginType::NORMAL:
				return $this->doNormalUserLogin($data);
				break;
			
			default:
				return $this->doSocialUserLogin($data);
				break;
		}
	}
	
	/**
	 * doNormalUserLogin
	 *
	 * @param  mixed $data
	 * @return void
	 */
	private function doNormalUserLogin($data)
    {
		$user = $this->iAuthRepository->checkUserExistsOrNot($data);

        if($user){
            if($user->verified == VerifyStatus::YES){
				$authAttempt = false;
				
                if(isset($data['email']) ){
                    $authAttempt = Auth::attempt(['email' =>  $data['email'],'password' => $data['password']]);  
                }

                if(isset($data['phone_number']) && !$authAttempt){
                    $authAttempt = Auth::attempt(['phone_number' => $data['phone_number'], 'password' => $data['password']]);    
                }

                if($authAttempt){
					$user->token = $user->createToken('Api access token')->accessToken;
					throw new SuccessException(trans('api/auth.success.logged_in_successfully'), new AuthResource($user));
                } else {
                    throw new BadRequestException(trans('api/auth.error.invalid_credentials')); 
                }
            } else {
                throw new BadRequestException(trans('api/auth.error.user_not_verified')); 
            }
        } else {
            throw new BadRequestException(trans('api/auth.error.invalid_credentials')); 
        }
	}
	
	/**
     * doSocialUserLogin
     *
     * @param  mixed $data
     * @return void
     */
    private function doSocialUserLogin($data)
    {
        $user = $this->iAuthRepository->where(['social_id' => $data['social_id']])->first();
        if($user){
			$user->token = $user->createToken('Api access token')->accessToken;
			throw new SuccessException(trans('api/auth.success.logged_in_successfully'), new AuthResource($user));
        } else {
            return $this->registerSocialUser($data);
        }   
    }
    
    /**
     * registerSocialUser
     *
     * @param  mixed $data
     * @return void
     */
    private function registerSocialUser($data){
        $user = $this->iAuthRepository->checkUserExistsOrNot($data);
             
        if(!$user){ 
            $insert_data = AuthHelper::get_insert_update_data($data);
			$user = $this->iAuthRepository->create($insert_data);
			$user->token = $user->createToken('Api access token')->accessToken;

			throw new SuccessException(trans('api/auth.success.logged_in_successfully'), new AuthResource($user));
        } else {
			throw new BadRequestException(trans('api/auth.error.invalid_credentials'));
		}     
    }

	
	/**
	 * register
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function register(AuthRegisterRequest $request)
	{
		$data = AuthHelper::get_register_request_data($request);
		$user = $this->iAuthRepository->checkUserExistsOrNot($data);

		if(!$user){
			$insert_data = AuthHelper::get_insert_update_data($data);
			$user = $this->iAuthRepository->create($insert_data);

			if($data['send_otp'] == SendOtpType::YES){
				
				/* #region  Send Otp Code */
				$otp_data = OtpHelper::get_send_otp_request_data($request);
				$insert_data = SendOTP::sendOtpForVerify($otp_data);
				$this->iOtpRepository->create($insert_data);
				/* #endregion */
				
				$user->token = '';
				$message = trans('api/auth.success.otp_sent_successfully');
			} else {
				$message = trans('api/auth.success.logged_in_successfully');
				$user->token = $user->createToken('Api access token')->accessToken;
			}

			throw new SuccessException($message, new AuthResource($user));
		} else {
			throw new BadRequestException(trans('api/auth.error.user_all_ready_exist')); 
		}
	}
			
	/**
	 * logout
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function logout(Request $request) {
		if ($request->user()->tokens->find(Auth::user()->token())->revoke()) {
			throw new SuccessException(trans('api/auth.success.logged_out_successfully'));
		}

		throw new SomeThingWentWrong(trans('api/auth.error.something_went_wrong'));
	}

	/**
	 * uploadImage
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function uploadImage(ImageUploadRequest $request) {
		$user = Auth::user();
		$user = $user->clearMediaCollection('avatar')->addMedia($request->image)->toMediaCollection('avatar');
		$success['url'] = $user->getUrl();

		throw new SuccessException(trans('api/auth.success.profile_update_successfully'),$success);
	}
}
