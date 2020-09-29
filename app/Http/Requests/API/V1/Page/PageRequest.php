<?php

namespace App\Http\Requests\API\V1\Page;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\API\V1\Common\FailedValidation;

class PageRequest extends FormRequest
{
    use FailedValidation;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "page_type" => 'required|integer',
            "version" => 'required|integer'
        ];
    }
}
