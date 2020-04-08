<?php

namespace App\Http\Resources;

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
        $jsonData = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email ? $this->email : $this->user->email,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'avatar' => $this->avatar_file_name,
            'mobile_number' => $this->mobile_number,
            'national_id' => $this->national_id,
        ];

        if($this->token) {
            $jsonData['token'] = $this->token;
        }

        return $jsonData;
    }
}
