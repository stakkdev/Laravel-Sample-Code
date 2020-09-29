<?php

namespace App\Enums\API\V1\Auth;

use BenSampo\Enum\Enum;

/**
 * @method static static NO()
 * @method static static YES()
 */
final class SendOtpType extends Enum
{
    const NO  =  0;
    const YES =  1;
}
