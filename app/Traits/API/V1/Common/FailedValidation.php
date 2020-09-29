<?php

namespace App\Traits\API\V1\Common;

use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\API\V1\ValidationException;

trait FailedValidation
{	
	/**
	 * failedValidation
	 *
	 * @param  mixed $validator
	 * @return void
	 */
	protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator->errors()->first());
    }
}
