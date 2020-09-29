<?php

namespace App\Exceptions\API\V1;

use Exception;
use Throwable;

class RecordNotFoundException extends Exception 
{  
    public function render()
    {
        throw $this;
    }
}
