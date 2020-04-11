<?php

namespace App\Http\Resources\API;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $email=User::select('email')->where('profile_id',$this->id)->first()->email;
        $jsonData = [
            'id' => $this->id,
            'name' => $this->name,
            'email' =>$this->user->email,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'avatar' => $this->avatar,
            'mobile_number' => $this->mobile_number,
            'national_ID' => $this->national_id,
        ];

        if ($this->token) {
            $jsonData['token'] = $this->token;
        }

        return $jsonData;
    }
}
