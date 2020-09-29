<?php

namespace App\Exceptions\API\V1;

use Exception;
use Throwable;

class ValidationException extends Exception 
{  
    public function render()
    {
        throw $this;
    }
}
