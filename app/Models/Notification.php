<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\API\V1\Notification\NotificationResource;

class Notification extends Model
{
    protected $guarded = [];

    // set the response resource
    public function setResource($notification)
    {
        return new NotificationResource($notification);
    }
}
