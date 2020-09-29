<?php

namespace App\Http\Requests\API\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

use BenSampo\Enum\Rules\EnumValue;
use App\Enums\API\V1\Auth\VerifyType;
use App\Enums\API\V1\Auth\ActionType;
use App\Traits\API\V1\Common\FailedValidation;

class OTPSendRequest extends FormRequest
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
     * 
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required_if:verify_type,==,'.VerifyType::EMAIL.'|email|nullable',
            'phone_number' => 'required_if:verify_type,==,'.VerifyType::PHONE.'|string|regex:/^([1-9][0-9]+)$/|between:7,12|nullable',
            'country_code' => 'required_with:phone_number|string|regex:/^(\+[1-9][0-9]+)$/|nullable',
            'verify_type' => [
                'required','integer',
                new EnumValue(VerifyType::class,false),
            ],
            'action_type' => [
                'required','integer',
                new EnumValue(ActionType::class,false),
            ],
        ];
    }
}
