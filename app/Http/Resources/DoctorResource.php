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
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->user->email,
            'created_at' => $this->created_at->format('Y-m-d'),
            'national_id' => $this->national_id,
            'avatar' => $this->avatar,
            'is_ban' => $this->is_ban ? 'True' : 'False',
            
           'action' => "<div class='row px-1'><a href=".route('doctors.edit', ['doctor' => $this->id])." data-toggle='tooltip' data-original-title='Edit' class='edit mr-1 btn btn-primary btn-sm editProduct'>Edit</a>

           
            <button type='button' onclick='deleteDoctor($this->id)' class='btn mr-1 btn-danger btn-sm'>Delete</button>".
            

           ($this->is_ban ? "<a class='btn btn-success ban btn-sm' href=".route('doctors.unban', ['doctor' => $this->id])."> Unban</a></div>" : 
           "<a class='btn btn-success ban btn-sm' href=".route('doctors.ban', ['doctor' => $this->id])."> Ban</a></div>"),

        ];

        if(auth()->user() && auth()->user()->hasrole('super-admin')) {

            // add pharmacy_name in the correct index
            $data = array_slice($data, 0, 6, true) +
            array("pharmacy_name" => $this->pharmacy->name) +
            array_slice($data, 6, count($data) - 1, true) ;
        }

        return $data;
    }
}
