<?php

namespace App\Repositories\API\V1\Auth;

use App\Repositories\API\V1\Common\GenericRepository;
use App\Repositories\API\V1\Interfaces\Auth\IAuthRepository;

class AuthRepository extends GenericRepository implements IAuthRepository
{
	public function model()
	{
		return 'App\User';
	}

	/**
     * checkUserExistsOrNot
     *
     * @param  mixed $data
     * @return void
     */
    public function checkUserExistsOrNot($data){
        // Check user exists by email  
        if(isset($data['email'])){
          	$user = $this->where(['email' => $data['email']])->first();  
        }

        // Check user exists by phone_number  
        if(isset($data['phone_number']) && isset($data['country_code']) && !isset($user)){
            $user = $this->where(['phone_number' => $data['phone_number'], 'country_code' => $data['country_code']])->first();                        
        }

        // Check user exists by social_id  
        if(isset($data['social_id']) && !isset($user)){
            $user = $this->where(['social_id' => $data['social_id']])->first();
        }

        return (isset($user)) ? $user : false;
	}
}
