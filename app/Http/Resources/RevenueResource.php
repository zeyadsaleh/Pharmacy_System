<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Order;

class RevenueResource extends JsonResource
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
            'avatar' => $this->avatar,
           'name' => $this->name,
           'count' => $this->count,
           'total_price' => '$'.Order::getPriceInDollars($this->total_price)
        ];
    }
}
