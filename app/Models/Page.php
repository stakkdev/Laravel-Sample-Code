<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\API\V1\Page\PageResource;

class Page extends Model
{
    protected $guarded = [];

    // set the response resource
    public function setResource($pageType)
    {
        return new PageResource($pageType);
    }
}
