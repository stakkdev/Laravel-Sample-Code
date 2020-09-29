<?php

use App\Enums\API\V1\Auth\LoginType;

return [

    LoginType::class => [
        LoginType::GMAIL => 'Gmail',
        LoginType::FACEBOOK => 'Facebook',
        LoginType::APPLE => 'Apple',
        LoginType::NORMAL => 'Normal',
    ],

];