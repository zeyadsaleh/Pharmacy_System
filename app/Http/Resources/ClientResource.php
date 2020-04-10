<?php

namespace App\Http\Resources;

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
            'action' => '<form method="GET" class="d-inline p-2" action="' . url("admin/clients", [$this->id, "edit"]) . '"><input type="hidden" name="_token" value="' . csrf_token() . '"><button type="submit" class="d-inline p-2 edit btn btn-primary">Edit</button></form>' . '<button type=""buttin" onclick="deleteClient('.$this->id.')" class="d-inline p-2 del btn btn-danger">Delete</button>',
        ];

        if ($this->token) {
            $jsonData['token'] = $this->token;
        }

        return $jsonData;
    }
}
