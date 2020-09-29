<?php

namespace App\Services\API\V1\Interfaces\Auth;

// load Custom Requests
use App\Http\Requests\API\V1\Auth\OTPSendRequest;
use App\Http\Requests\API\V1\Auth\OTPVerifyRequest;

interface IOtpService
{
	public function sendOTP(OTPSendRequest $request);
	public function verifyOTP(OTPVerifyRequest $request);
}
