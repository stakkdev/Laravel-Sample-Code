<?php

namespace App\Helpers\API\V1;

use Illuminate\Support\Facades\Hash;
use App\Enums\API\V1\Auth\ActionType;
use App\Enums\API\V1\Auth\VerifyType;

class OtpHelper {

    public static function get_send_otp_request_data($request)
	{
		return [
            'email' => $request->email,
            'verify_type' => $request->verify_type ?? VerifyType::EMAIL,
            'phone_number' => $request->phone_number,
            'country_code' => $request->country_code,
            'action_type' => $request->action_type ?? ActionType::Otp
        ];
    }

    public static function get_verify_otp_request_data($request)
	{
		return [
            'otp' => $request->otp,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password) ?? "",
            'country_code' => $request->country_code,
            'verify_type' => $request->verify_type ?? VerifyType::EMAIL,
            'action_type' => $request->action_type ?? ActionType::Otp
        ];
    }

    public static function get_phone_verify_conditions_data($request)
	{
		return [
            'user_condition' => [
                'phone_number' => $request->phone_number,
                'country_code' => $request->country_code,
            ],
            'otp_condition' => [
                'otp' => $request->otp,
                'is_verified' => '0',
                'phone_number' => $request->phone_number,
                'country_code' => $request->country_code,
            ]
        ];
    }

    public static function get_mail_verify_conditions_data($request)
	{
		return [
            'user_condition' => [
                'email' => $request->email,
            ],
            'otp_condition' => [
                'otp' => $request->otp,
                'is_verified' => '0',
                'email' => $request->email,
            ]
        ];
    }
}
