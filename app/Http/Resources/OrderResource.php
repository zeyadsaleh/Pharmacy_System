<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
     public function toArray($request)
     {
        // print_r ($this->created_at);
         return [
           'id' => $this->id,
           'user_id' => $this->user_id ? $this->user->name : "Not exist",
           'delivering_address' => $this->delivering_address,
           'created_at' => $this->created_at,
           'doctor_id' => $this->doctor_id ? "Dr. ".$this->user->name: "",
           'is_insured' => $this->is_insured ? "Yes" : "No",
           'status' => $this->status,

           'action' => '<form method="GET" class="d-inline p-2" action="'.url("orders", [ $this->id, "edit"]).'"><input type="hidden" name="_token" value="'.csrf_token().'"><button type="submit" class="d-inline p-2 edit btn btn-primary">Edit</button></form>'.'<form method="POST" class="d-inline p-2" action="'.url("orders", $this->id).'"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'"><button type="submit" class="d-inline p-2 del btn btn-danger">Delete</button></form>',

           'created_by' => $this->created_by,
           'pharmacy_id' => $this->pharmacy_id ? $this->pharmacy_id->name : "",
         ];
     }
   }
