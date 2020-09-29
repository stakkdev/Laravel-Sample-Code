<?php

namespace App\Traits\Common;

use Illuminate\Http\Response as IlluminateResponse;

trait VerifyOTP
{    
    /**
     * verifyUserOtp
     *
     * @param  mixed $data
     * @return void
     */
    public function verifyUserOtp($data){
        $conditions = [
            'otp' => $data['otp'],
            'is_verified' => '0',
        ];

        if($data['verify_type'] == 1){
            $conditions['phone_number'] = $data['phone_number'];
            $conditions['country_code'] = $data['country_code'];
        } elseif($data['verify_type'] == 2){
            $conditions['email'] = $data['email'];
        }

        $validOtp = $this->otpRepository->where($conditions)->orderBy('id', 'DESC')->limit(1)->first();

        if (isset($validOtp)) {
            $validOtp->update(['is_verified' => '1']);

            switch (isset($data['action'])) {
                case '2':// if action is 2 then verify user also
                    return $this->verifyUser($data);
                    break;
                
                case '3': // if action is 3 then update the authorized user details also
                    $user = auth()->user();
                    if($data['verify_type'] == 1){
                        $user->update(['phone_number' => $data['phone_number'], 'country_code' => $data['country_code']]);
                    } else if($data['verify_type'] == 2) {
                        $user->update(['email' => $data['email']]);
                    }

                    return $this->reponseSuccess("", trans('api/user.OTPVerifiedSuccessfullAndUserUpdated'));
                    break;
            }

            return $this->reponseSuccess("", trans('api/user.OTPVerifiedSuccessfull'));

        } else {
            $this->setStatusCode(400);
            return $this->respondWithError(trans('api/user.OTPInvalid'));
        }
    }

    /**
     * verifyUser
     *
     * @param  mixed $data
     * @return void
     */
    public function verifyUser($data) {

        if($data['verify_type'] == 1){
            $conditions['phone_number'] = $data['phone_number'];
            $conditions['country_code'] = $data['country_code'];
        } elseif($data['verify_type'] == 2){
            $conditions['email'] = $data['email'];
        }

        $user = $this->userRepository->where($conditions)->first();
        if (isset($user)) {
            $user->update(['verified' => '1']);
            return $this->reponseSuccess("", trans('api/user.OTPVerifiedSuccessfull'));
        } else {
            return $this->reponseSuccess("", trans('api/user.OTPVerifiedSuccessfullButUserDoesntExists'));
        }
    }
}
