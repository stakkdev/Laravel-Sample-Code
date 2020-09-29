<?php

namespace App\Http\Resources\API\V1\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [
            'id' => $this->id,
            'login_type' => $this->login_type,
            'email' => $this->email,
            'name' => $this->name,
            'image' => $this->getAvatarThumbUrlAttribute() ?? "",
            'phone_number' => $this->phone_number,
            'country_code' => $this->country_code,
            'country_iso_code' => $this->country_iso_code,
            'verified' => $this->verified
        ];

        if (isset($this->token)) {
            $response['token'] = $this->token;
        }

        return $response;
    }
}
