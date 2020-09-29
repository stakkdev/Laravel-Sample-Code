<?php

namespace App\Enums\API\V1\Auth;

use BenSampo\Enum\Enum;

/**
 * @method static static PHONE()
 * @method static static EMAIL()
 */
final class VerifyType extends Enum
{
    const PHONE =   1;
    const EMAIL =   2;
}
