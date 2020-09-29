<?php

namespace App\Http\Resources\API\V1\Interfaces;

interface IHandler
{
	public function transformModel($content);
}
