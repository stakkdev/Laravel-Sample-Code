<?php

namespace App\Repositories\API\V1\Auth;

use App\Repositories\API\V1\Common\GenericRepository;
use App\Repositories\API\V1\Interfaces\Auth\IOtpRepository;

class OtpRepository extends GenericRepository implements IOtpRepository
{
	public function model()
	{
		return 'App\Models\Otp';
	}
}
