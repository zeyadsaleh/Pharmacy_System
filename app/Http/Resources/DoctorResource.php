<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this->created_at);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->user->email,
           'created_at' => $this->created_at->format('Y-m-d'),
           'national_id' => $this->national_id,
           'avatar' => $this->avatar,

           'action' => "<a href=".route('pharmacies.doctors.edit', ['doctor' => $this->id])." data-toggle='tooltip' data-original-title='Edit' class='edit mx-1 btn btn-primary btn-sm editProduct'>Edit</a>

           <form method='POST' id='delete-$this->id' class='d-inline' action=".route('pharmacies.doctors.delete', ['doctor' => $this->id]).">
                <input type='hidden' name='_token' value='".csrf_token()."'>
                <input type='hidden' name='_method' value='DELETE'>
                <button type='button' onclick='deleteDoctor($this->id)' class='btn mx-1 btn-danger btn-sm'>Delete</button>
            </form>".

           ($this->is_ban ? "<a class='btn btn-success ban btn-sm' href=".route('pharmacies.doctors.unban', ['doctor' => $this->id])."> Unban</a>" : 
           "<a class='btn btn-success ban btn-sm' href=".route('pharmacies.doctors.ban', ['doctor' => $this->id])."> Ban</a>"),

           'is_ban' => $this->is_ban,
        //    'pharmacy_id' => $this->pharmacy_id ? $this->pharmacy->name : "",
        ];
    }
}
