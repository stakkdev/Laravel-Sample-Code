<?php

namespace App\Services\API\V1\Auth;

use App\Helpers\API\V1\OtpHelper;
use Illuminate\Support\Facades\Hash;
use App\Enums\API\V1\Auth\ActionType;
use App\Enums\API\V1\Auth\VerifyType;
use App\Enums\API\V1\Auth\VerifyStatus;

use App\Traits\API\V1\Common\SendOTP;
use App\Exceptions\API\V1\SuccessException;
use App\Exceptions\API\V1\BadRequestException;

use App\Http\Requests\API\V1\Auth\OTPSendRequest;
use App\Http\Requests\API\V1\Auth\OTPVerifyRequest;

use App\Services\API\V1\Interfaces\Auth\IOtpService;

use App\Repositories\API\V1\Interfaces\Auth\IOtpRepository;
use App\Repositories\API\V1\Interfaces\Auth\IAuthRepository;

class OtpService implements IOtpService
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
	 * sendOTP
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function sendOTP(OTPSendRequest $request){
		$data = OtpHelper::get_send_otp_request_data($request);
		$insert_data = SendOTP::sendOtpForVerify($data);

		$this->iOtpRepository->create($insert_data);
		throw new SuccessException(trans('api/auth.success.otp_sent_successfully'));
	}
	
	/**
	 * verifyOTP
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function verifyOTP(OTPVerifyRequest $request){
		$data = OtpHelper::get_verify_otp_request_data($request);

		if($data['verify_type'] == VerifyType::PHONE) {
			$params = OtpHelper::get_phone_verify_conditions_data($request);
        } elseif ($data['verify_type'] == VerifyType::EMAIL){
			$params = OtpHelper::get_mail_verify_conditions_data($request);
		}

		$validOtp = $this->iOtpRepository->where($params['otp_condition'])->orderBy('id', 'DESC')->limit(1)->first();

		if($validOtp){
			$validOtp->update(['is_verified' => '1']);
			$message = trans('api/auth.success.otp_verified_successfully');

			if($data['action_type'] == ActionType::Otp) {
				/* #region request for otp verification */
				$message = trans('api/auth.success.otp_verified_successfully');
				/* #endregion */
			} elseif ($data['action_type'] == ActionType::OtpAndUser){
				/* #region  request for otp and user verification */
				$message = $this->userVerification($params);
				/* #endregion */
			} elseif ($data['action_type'] == ActionType::OtpAndUserUpdate){
				/* #region request for authorized user updated */
				$message = $this->authorizedUserUpdate($params);
				/* #endregion */
			} elseif ($data['action_type'] == ActionType::ForgetPassword){
				/* #region  request for user password updated  */
				$message = $this->userPasswordUpadte($params,$data['password']);
				/* #endregion */
			}

			throw new SuccessException($message);
		} else {
			throw new BadRequestException(trans('api/auth.error.otp_invalid'));
		}
	}
	
	/**
	 * userVerification
	 *
	 * @param  mixed $params
	 * @return void
	 */
	private function userVerification($params) {
		$user = $this->iAuthRepository->where($params['user_condition'])->first();
		if ($user) {
			$user->update(['verified' => VerifyStatus::YES]);
			$message = trans('api/auth.success.otp_and_user_verified_successfully');
		} else {
			$message = trans('api/auth.success.otp_verified_successfully_but_user_doesnt_exists');
		}

		return $message;
	}
	
	/**
	 * authorizedUserUpdate
	 *
	 * @param  mixed $params
	 * @return void
	 */
	private function authorizedUserUpdate($params) {
		$user = auth()->user();
		if($user){
			$user->update($params['user_condition']);
			$message = trans('api/auth.success.otp_verified_successfully_and_user_updated');
		} else {
			$message = trans('api/auth.error.user_not_loggedin');
		}

		return $message;
	}
	
	/**
	 * userPasswordUpadte
	 *
	 * @param  mixed $params
	 * @param  mixed $password
	 * @return void
	 */
	private function userPasswordUpadte($params,$password) {
		$user = $this->iAuthRepository->where($params['user_condition'])->first();
		if ($user) {
			$user->update(['password' => $password]);
			$message = trans('api/auth.success.updated_successfully');
		} else {
			$message = trans('api/auth.success.otp_verified_successfully_but_user_doesnt_exists');
		}

		return $message;
	}
}
