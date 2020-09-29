<?php

namespace App\Traits\API\V1\Auth;

// load Custom Requests
use App\Http\Requests\API\V1\Auth\OTPSendRequest;
use App\Http\Requests\API\V1\Auth\OTPVerifyRequest;

use App\Services\API\V1\Interfaces\Auth\IOtpService;

trait OtpActions
{
	private $iOtpService;

	public function __construct(IOtpService  $iOtpService)
	{
		$this->iOtpService = $iOtpService;
	}
	
	/**
	 * sendOTP
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function sendOTP(OTPSendRequest $request)
	{
		return  $this->iOtpService->sendOTP($request);
	}

	
	/**
	 * verifyOTP
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function verifyOTP(OTPVerifyRequest $request)
	{
		return  $this->iOtpService->verifyOTP($request);
	}
}
