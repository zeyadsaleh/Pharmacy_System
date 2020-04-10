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
        $arr;
        $thisArr = $this->toArray();
        for($i = 0; $i < count($thisArr); $i++){
            $arr[] = [
                'id' => $thisArr[$i]->id,
                'street_name'=> $thisArr[$i]->street_name,
                'building_name' => $thisArr[$i]->building_name,
                'floor_number' => $thisArr[$i]->floor_number,
                'is_main' => $thisArr[$i]->is_main ? "True" : "Flase",
                'created_at' => $thisArr[$i]->created_at ? $thisArr[$i]->created_at->format("d/m/Y H:i") : "",
                'updated_at' => $thisArr[$i]->updated_at ? $thisArr[$i]->updated_at->format("d/m/Y H:i") : "",
                'user_id' => $thisArr[$i]->user_id,
                'area_id' => $thisArr[$i]->area_id
            ];
        }

        return $arr;
        // return [
        //     'id' => $this[$i]->id,
        //     'street_name'=> $this[$i]->street_name,
        //     'building_name' => $this[$i]->building_name,
        //     'floor_number' => $this[$i]->floor_number,
        //     'is_main' => $this[$i]->is_main ? "True" : "Flase",
        //     'created_at' => $this[$i]->created_at ? $this[$i]->created_at->format("d/m/Y H:i") : "",
        //     'updated_at' => $this[$i]->updated_at ? $this[$i]->updated_at->format("d/m/Y H:i") : "",
        //     'user_id' => $this[$i]->user_id,
        //     'area_id' => $this[$i]->area_id

        // ];  
    }  
}
