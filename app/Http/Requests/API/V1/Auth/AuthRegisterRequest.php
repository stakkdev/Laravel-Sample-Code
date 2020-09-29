<?php

namespace App\Http\Requests\API\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

// load Custom Traits
use App\Traits\API\V1\Common\FailedValidation;

class AuthRegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|regex:/^([a-z A-Z]+)$/',
            'phone_number' => 'required|string|regex:/^([1-9][0-9]+)$/|unique:users,phone_number|between:7,12',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%#*?&]{8,}$/',
            'country_code' => 'required_with:phone_number|string|regex:/^(\+[1-9][0-9]+)$/',
            'country_iso_code' => 'required_with:phone_number|string|regex:/^([a-zA-Z]+)$/|between:1,3',
        ];
    }
    
    /**
     * messages
     * 
     * Get the validation messages that apply to the rule.
     *
     * @return void
     */
    public function messages()
    {
        return [
            'password.regex' => 'Password must contain atleast One Uppercase, One Lowercase and One Special Character',
            'phone_number.unique' => 'Phone no. Already registered',
            'email.unique' => 'Email Already registered'
        ];
    }
}
