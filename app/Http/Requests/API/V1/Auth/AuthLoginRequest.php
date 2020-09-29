<?php

namespace App\Http\Requests\API\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

use BenSampo\Enum\Rules\EnumValue;
use App\Enums\API\V1\Auth\LoginType;
use App\Traits\API\V1\Common\FailedValidation;

class AuthLoginRequest extends FormRequest
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
            'login_type' => [
                'required','integer',
                new EnumValue(LoginType::class,false),
            ],
            'email' => 'required|email',
            'social_id' => 'required_unless:login_type,'. LoginType::NORMAL,
            'name' => 'required_unless:login_type,'. LoginType::NORMAL . '|string',
            'profile_picture' => 'string|nullable',
            'phone_number' => 'required|string|regex:/^([1-9][0-9]+)$/|between:7,12',
            'password' => 'required|string',
            'country_code' => 'required_with:phone_number|string|regex:/^(\+[1-9][0-9]+)$/',
            'country_iso_code' => 'required_with:phone_number|string|between:1,3',
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
        ];
    }
}
