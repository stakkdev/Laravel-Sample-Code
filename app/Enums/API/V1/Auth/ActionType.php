<?php

namespace App\Enums\API\V1\Auth;

use BenSampo\Enum\Enum;

/**
 * @method static static Otp()
 * @method static static OtpAndUser()
 * @method static static OtpAndUserUpdate()
 * @method static static ForgetPassword()
 */
final class ActionType extends Enum
{
    const Otp =  1;
    const OtpAndUser =  2;
    const OtpAndUserUpdate = 3;
    const ForgetPassword = 4;
}
