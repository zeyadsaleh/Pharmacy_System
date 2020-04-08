<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Order;

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
        
        if ($user->hasRole('pharmacy') || $user->hasRole('admin')) {
            $action = '<form method="GET" class="d-inline p-2" action="'.url("orders", [ $this->id, "edit"]).'"><button type="submit" class="d-inline p-2 edit btn btn-primary">Edit</button></form>'.'<form method="POST" class="d-inline p-2" id="delete'.$this->id.'" action="'.url("orders", $this->id).'"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'"><button class="d-inline p-2 del btn btn-danger" onclick="deleteOrder('.$this->id.')">Delete</button></form>';
        } elseif ($user->hasRole('doctor')) {
            $action = '<form method="POST" class="d-inline p-2" id="delete'.$this->id.'" action="'.url("orders", $this->id).'"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'"><button class="d-inline p-2 del btn btn-danger" onclick="deleteOrder('.$this->id.')">Delete</button></form>';
        }else{
          $action = null;
        }

         return [
           'id' => $this->id,
           'user_id' => $this->user_id ? $this->user->name : "Not exist",
           'delivering_address' => $this->address,
           'created_at' => $this->created_at ? $this->created_at->format("d/m/Y \n H:i") : "",
           'doctor_id' => $this->doctor_id ? "Dr. ".$this->doctor->name: "",
           'is_insured' => $this->user->is_insured ? "Yes" : "No",
           'status' => $this->status,

           'action' => $action,

           'created_by' => $this->created_by,
           'pharmacy_id' => $this->pharmacy_id ? $this->pharmacy->name : "",
         ];
     }
   }

      //
      // 'id' => $this->id,
      //
      // 'user_id' => $this->user_id ? $this->user->name : "Not exist",
      //
      // 'delivering_address' => $this->delivering_address ? "St. ".$this->address->street_name."\nBld. ".$this->address->building_name : "",
      //
      // 'created_at' => $this->created_at ? $this->created_at->format('d/m/Y || H:i') : "",
      //
      // 'doctor_id' => $this->doctor_id ? "Dr. ".$this->doctor->name: "",
      //
      // 'is_insured' => $this->user->is_insured ? "Yes" : "No",
      //
      // 'status' => $this->status,
      //
      // 'action' => '<form method="GET" class="d-inline p-2" action="'.url("orders", [$this->id, "edit"]).'"><input type="hidden" name="_token" value="'.csrf_token().'"><button type="submit" class="d-inline p-2 edit btn btn-primary">Edit</button></form>'.'<form method="POST" class="d-inline p-2" id="delete" action="'.url("orders", $this->id).'"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'"><button class="d-inline p-2 del btn btn-danger">Delete</button></form>',
      //
      // 'created_by' => $this->created_by,
      //
      // 'pharmacy_id' => $this->pharmacy_id ? $this->pharmacy->name : "",
