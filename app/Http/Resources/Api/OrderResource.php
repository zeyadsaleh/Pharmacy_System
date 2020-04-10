<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Order;
use App\Medicine;
use App\OrderMedicine;


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

      $medicines = $this->getMedicines($this->id);
      $pharmacy = $this->getPharmacy($this->pharmacy);

      $datas = [
        'id' => $this->id,
        'medicine' => $medicines,
        'status' => $this->status,
        'created_at' => $this->created_at->format("H:i"),
        'total_price' => $this->total_price,
        'assigned_pharmacy' => $pharmacy,
      ];

       return $datas;    }

private function getMedicines($order){
  $medicines = [];
  $medicines_all = OrderMedicine::where('order_id', $order)->get();

    if(isset($medicines_all) && !empty($medicines_all)){
    foreach($medicines_all as $medicine){
      $object = (object)['name'=> Medicine::find($medicine->medicine_id)->name ,
                         'type' => Medicine::find($medicine->medicine_id)->type,
                         'quantity' => $medicine->quantity,
                         'price' => $medicine->price];
      array_push($medicines, $object);
    }
    return $medicines;

    }else{
      return null;
    }
  }

  private function getPharmacy($pharmacy){
    if(isset($pharmacy) && !empty($pharmacy)){
      return ['id' => $this->pharmacy->id ,
              'pharmacy_name' => $this->pharmacy->name,
              'address' => $this->pharmacy->area->address ,
              'avatar_img' => $this->pharmacy->avatar];
    }else{
      return null;
    }
  }

}
