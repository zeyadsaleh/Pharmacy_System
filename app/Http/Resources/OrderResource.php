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
           'action' => '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$this->user_id.'"   data-original-title="Edit" class="edit btn btn-primary btn-sm editorder">Edit</a>',
           'created_by' => $this->created_by,
           'pharmacy_id' => $this->pharmacy_id ? $this->pharmacy_id->name : "",
         ];
     }
   }
