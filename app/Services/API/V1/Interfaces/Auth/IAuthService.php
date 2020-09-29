<?php

namespace App\Services\API\V1\Interfaces\Auth;

// load Custom Requests
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Auth\AuthLoginRequest;
use App\Http\Requests\API\V1\Auth\ImageUploadRequest;
use App\Http\Requests\API\V1\Auth\AuthRegisterRequest;

interface IAuthService
{
	public function login(AuthLoginRequest $request);

	public function register(AuthRegisterRequest $request);

	public function logout(Request $request);

	public function uploadImage(ImageUploadRequest $request);
}
