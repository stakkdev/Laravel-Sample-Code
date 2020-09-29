<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;

use App\Traits\API\V1\Auth\OtpActions;

class OtpController extends Controller
{
    use OtpActions;
}
