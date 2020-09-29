<?php

namespace App\Traits\API\V1\Common;

use Mail;
use Twilio\Rest\Client;
use App\Mail\SendMailOTP;
use Twilio\Exceptions\RestException;
use App\Enums\API\V1\Auth\VerifyType;
use App\Exceptions\API\V1\BadRequestException;
use Illuminate\Http\Response as IlluminateResponse;

trait SendOTP
{
	public static function get_otp()
	{
		return self::get_random_otp();
	}

	private static function get_static_otp()
	{
		return 6666;
    }
    
	private static function get_random_otp()
	{
		return rand(1000, 9999);
	}
    
    public static function sendOtpForVerify($data){
        $otp = self::get_otp();
        $otp_save_data = [];
        
        if($data['verify_type'] == VerifyType::PHONE) {
            $otp_save_data = self::sendPhoneOTP(['phone_number' => $data['phone_number'],'country_code' => $data['country_code'], 'otp' => $otp]);
        } elseif($data['verify_type'] == VerifyType::EMAIL){
            $otp_save_data = self::sendMailOTP(['email' => $data['email'], 'otp' => $otp]);
        }

        if($otp_save_data){
            return $otp_save_data;
        } else {
            throw new BadRequestException('OTP not send. Please try again later.');
        }
    }
    
    /**
     * sendMailOTP
     *
     * @param  mixed $data
     * @return void
     */
    private static function sendMailOTP($data) {
        $otp = $data['otp'];
        $email = $data['email'];
        $status = self::send_otp_using_mail($email, $otp);
        
        return ($status) ? $data : false;
    }
    
    /**
     * send_otp_using_mail
     *
     * @param  mixed $email
     * @param  mixed $otp
     * @return void
     */
    private static function send_otp_using_mail($email, $otp){
        $message = "Your OTP for " . env('APP_NAME') . " is :- " . $otp . ". Please don't share it with anybody";
        $status = Mail::to($email)->send(new SendMailOTP($message));
        
        return (count(Mail::failures()) > 0) ? false : true;
    }
    
    /**
     * sendPhoneOTP
     *
     * @param  mixed $data
     * @return void
     */
    private static function sendPhoneOTP($data) {
        $otp_code = $data['otp'];
        $phone_number = $data['country_code'] . $data['phone_number'];
        $status = self::send_otp_using_twilio($phone_number, $otp);

        return ($status) ? $data : false;
    }
    
    /**
     * send_otp_using_twilio
     *
     * @param  mixed $phone_number
     * @param  mixed $otp
     * @return void
     */
    private static function send_otp_using_twilio($phone_number, $otp)
	{
		$account_sid = env('TWILIO_SID');
		$auth_token = env('TWILIO_TOKEN');
		$twilio_sms_from_number = env('TWILIO_SMS_FROM_NUMBER');
		$client = new Client($account_sid, $auth_token);
		try {
			$status = $client->messages->create(
				// Where to send a text message (your cell phone?)
				$phone_number,
				array(
					'from' => $twilio_sms_from_number,
					'body' => "Your OTP for " . env('APP_NAME') . " is :- " . $otp . ". Please don't share it with anybody"
				)
            );
		} catch (RestException $ex) {
			$message = self::getTwilioMessage($ex->getMessage());
			throw new BadRequestException($message);
        }
        
        return ($status) ? true : false;
	}
	
	/**
	 * getTwilioMessage
	 *
	 * @param  mixed $message
	 * @return void
	 */
	private static function getTwilioMessage($message = '')
	{
        if ($message) {
            $array_message = explode(':', $message);
            if (isset($array_message[1])){
                return $array_message[1];
            }
        }

        return trans('Api/v1/auth.cannot_sed_the_message_on_this_number');
	}
}
