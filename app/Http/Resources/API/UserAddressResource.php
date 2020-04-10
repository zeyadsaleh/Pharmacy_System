<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'street_name'=> $this->street_name,
            'building_name' => $this->building_name,
            'floor_number' => $this->floor_number,
            'is_main' => $this->is_main ? "True" : "Flase",
            'created_at' => $this->created_at ? $this->created_at->format("d/m/Y H:i") : "",
            'updated_at' => $this->updated_at ? $this->updated_at->format("d/m/Y H:i") : "",
            'user_id' => $this->user_id,
            'area_id' => $this->area_id

        ];  
    }  
}
