<?php

namespace App\Http\Resources;

use App\Area;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class DeletedPharmacyResource extends JsonResource
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
            'name' => $this->name ? $this->name : 'no data',
            'email' => 'email',
            // 'email' => User::select('email')->where('profile_id',$this->id)->get()[0]->email ? User::select('email')->where('profile_id',$this->id)->get()[0]->email : 'no data',
            'national_id' => $this->national_id ? $this->national_id : 'no data',
            'area'=> $this->area_id ? Area::find($this->area_id)->name : 'no data',
            'avatar' => $this->avatar ? $this->avatar : 'no image',
            'priority' => $this->priority ? $this->priority : 'no data',
            'action' => '<form method="POST" class="d-inline p-2" id="restore" action="' . url("admin/pharmacies", $this->id) . '"><input type="hidden" name="_method" value="PATCH"><input type="hidden" name="_token" value="' . csrf_token() . '"><button type=""submit" class="d-inline p-2 del btn btn-success">Restore</button></form>',
        ];
    }
}
