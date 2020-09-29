<?php

namespace App\Exceptions\API\V1;

use Exception;
use Throwable;

class SuccessException extends Exception
{
    protected $data;

    public function __construct(string $message, $data = "")
    {
        $this->data = $data;
        parent::__construct($message);
    }

    public function getData()
    {
        return $this->data;
    }

    public function render()
    {
        throw $this;
    }
}
