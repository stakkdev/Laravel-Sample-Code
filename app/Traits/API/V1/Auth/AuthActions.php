<?php

namespace App\Traits\API\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Auth\AuthLoginRequest;
use App\Http\Requests\API\V1\Auth\ImageUploadRequest;
use App\Http\Requests\API\V1\Auth\AuthRegisterRequest;

use App\Services\API\V1\Interfaces\Auth\IAuthService;

trait AuthActions
{
	private $iAuthService;

	public function __construct(IAuthService  $iAuthService)
	{
		$this->iAuthService = $iAuthService;
	}
	
	/**
	 * login
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function login(AuthLoginRequest $request)
	{
		return  $this->iAuthService->login($request);
	}


	/**
	 * register
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function register(AuthRegisterRequest $request)
	{
		return  $this->iAuthService->register($request);
	}
	
	/**
	 * logout
	 *
	 * @return void
	 */
	public function logout(Request $request)
	{
		return  $this->iAuthService->logout($request);
	}

	/**
	 * uploadImage
	 *
	 * @return void
	 */
	public function uploadImage(ImageUploadRequest $request)
	{
		return  $this->iAuthService->uploadImage($request);
	}
}
