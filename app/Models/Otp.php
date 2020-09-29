<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{

    protected $fillable = [
        'otp',
        'email',
        'phone_number',
        'country_code',
        'is_verified'
    ];
}
