<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use App\Medicine;
use App\Address;
use App\Pharmacy;
use App\Client;
use App\User;
use App\OrderMedicine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\OrderResource;
use Illuminate\Validation\ValidationException;


class OrderController extends Controller
{

    public function index()
    {
      $client = auth()->user();
        return OrderResource::collection(Order::where('user_id',$client->id)->get());
    }


    public function show(Request $request)
    {
      $client = auth()->user();

      if(isset($client) || !empty($client)) {
        $orders = Order::where('user_id',$client->id)->get();
        if($orders->first() == null){
          return json_encode("You do not have any orders");
        }else{
          $order = $orders->where('user_id',$client->id);
          if($order->first() == null){
            return json_encode("This order not available");
          }else{
            return new OrderResource($order);
          }
        }
      }else{
        return json_encode("Your are not valid");
      }
    }


    public function update(Request $request)
    {

      $client_orders = auth()->user()->order;

      if(isset($client_orders) ||  !empty($client_orders)){
          $order = $client_orders::find($request->order);
        }else{
          return json_encode("Your are not valid");
        }
      // $order = Order::find($request->order);
      if(isset($order) ||  !empty($order)){
          if ($request->order->status == 'New' ){
          $order->update([
              'status' => $request->status ? $request->status : $request->order->status,
          ]);
      }
      $count = 0;
      foreach($order->medicines as $medicine){
          $count++;
          if ($request->input('name'.$count) == null){ break; }
          $order_medicine = OrderMedicine::where('order_id', $order->id)->where('medicine_id', $medicine->id)->first();
          $price = $order_medicine->price/$order_medicine->quantity;
          $medicine->update([
            'name' => $request->input('name'.$count),
            'type' => $request->input('type'.$count),
          ]);
          $order_medicine->update([
            'quantity' => input('quantity'.$count),
            'price' => $price,
          ]);
      }
        return new OrderResource(Order::find($request->order));
      }else{
        return json_encode("you did'nt have any order yet!");
      }
    }


    public function store(Request $request)
    {
      $client = auth()->user();
      // $client = 1;
      if(isset($client) || !empty($client)) {

        $order = $this->storeOrder($request);

        foreach (range(1, 15) as $i) {

          if( $request->input('quantity'.$i) == null ){ break;}

          $medicine = $this->getMedicine($request, $i);

          OrderMedicine::create([
            'order_id' => $order->id,
            'medicine_id' => $medicine->id,
            'quantity' => $request->input('quantity'.$i),
          ]);
        }
        return new OrderResource(Order::find($order));
      }else{
        return json_encode("Your are not valid");
      }
    }

    private function storeOrder($request){

      $client = auth()->user();
      // $client =2;
      if(isset($client)){
            $address = Address::where('user_id', $client->id)->first();
            // $pharmacies = Pharmacy::where('area_id',$address->area_id)->get();
            // if(!isset($pharmacies) || empty($pharmacies)){return json_encode("your address out of serving range!");}
            // $pharmacy = $pharmacies->orderBy('priority', 'desc')->first();
            $created_by = 'User';

      return Order::create([
          'delivering_address' => $address ? $address->id : "user address is unavailable",
          'created_by' => 'User',
          'status'=> 'New',
          // 'pharmacy_id' => isset($pharmacy) ? $pharmacy->id: null,
          'user_id'=> $client->id,
          ]);
        }else{
          return json_encode("Your are not valid");
        }
      }

    private function getMedicine($request, $i){
      $medicine = Medicine::where('name', $request->input('name'.$i))->where('type', $request->input('type'.$i))->first();
      if(!isset($medicine) && empty($medicine)){
        return json_encode("This medicine is unavailable");
        }else{
          return $medicine;
        }
      }

  }
