<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsrAdrsResource extends JsonResource
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
            'client' => $this->name ? $this->name : 'no data',
            'nat' => $this->national_id ? $this->national_id : 'no data',
            'street' => $this->street_name ? $this->street_name : 'no data',
            'building' => $this->building_name ? $this->building_name : 'no data',
            'floor' => $this->floor_number ? $this->floor_number : 'no data',
            'flat' => $this->flat_number ? $this->flat_number : 'no data',
            'action' => '<form method="GET" class="d-inline p-2" action="' . url("admin/userAddresses", [$this->id, "edit"]) . '"><input type="hidden" name="_token" value="' . csrf_token() . '"><button type="submit" class="d-inline p-2 edit btn btn-primary">Edit</button></form>' . '<form method="POST" class="d-inline p-2" id="delete" action="' . url("admin/userAddresses", $this->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><button type=""buttin" onclick="deleteAddress('.$this->id.')" class="d-inline p-2 del btn btn-danger">Delete</button></form>',


        ];
    }
}
