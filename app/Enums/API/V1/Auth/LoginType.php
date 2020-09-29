<?php

namespace App\Enums\API\V1\Auth;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static GMAIL()
 * @method static static FACEBOOK()
 * @method static static APPLE()
 * @method static static NORMAL()
 */
final class LoginType extends Enum implements LocalizedEnum
{
    const GMAIL =   1;
    const FACEBOOK =   2;
    const APPLE = 3;
    const NORMAL = 4;
}
