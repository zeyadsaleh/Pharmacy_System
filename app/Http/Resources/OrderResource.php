<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Address;


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
        $user = Auth::User();

        $action = '<form method="GET" class="d-inline p-2" action="'.url("orders", [ $this->id]).'"><button type="submit" class="btn btn-success">Details</button></form>'.'<form method="GET" class="d-inline p-2" action="'.url("orders", [ $this->id, "edit"]).'"><button type="submit" class="d-inline p-2 edit btn btn-primary">Edit</button></form>'.'<button type="button" class="d-inline p-2 del btn btn-danger" onclick="deleteOrder('.$this->id.')"">Delete</button>';

        $address = Address::where('id', $this->delivering_address)->first();
 
        $datas = [
          'id' => $this->id,
          'user_id' => $this->user_id ? $this->user->name : "Not exist",
          'delivering_address' => $this->delivering_address ? "St. ".$address->street_name: "user addres not available",
          'is_insured' => $this->user->is_insured ? "Yes" : "No",
          'status' => $this->status,
          'pharmacy_id' => $this->pharmacy_id ? $this->pharmacy->name : "",
          'doctor_id' => $this->doctor_id ? "Dr. ".$this->doctor->name: "",
          'created_at' => $this->created_at ? $this->created_at->format("d/m/Y \n H:i") : "",
        ];


        // if ($user->hasrole('admin')) {
        //   $datas['created_by']=$this->created_by;
        // }

        $datas['action']=$action;

         return $datas;
     }
   }
