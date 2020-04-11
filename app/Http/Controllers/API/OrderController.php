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
use App\Http\Resources\API\OrderResource;
use Illuminate\Validation\ValidationException;


class OrderController extends Controller
{

    public function index()
    {
      $user = $this->getUser();
        return OrderResource::collection(Order::where('user_id',$user->id)->get());
    }


    public function show(Request $request)
    {
      $user = $this->getUser();
      if($user){
        $order = $this->getOrder($user, $request->order);
        if( $order == false){
          return json_encode("you did nt have this order");
      }else{
        return new OrderResource($order);
      }
      }else{
        return json_encode("Your are not valid");
      }
    }


    public function update(Request $request)
    {
      $user = $this->getUser();
      if($user){
        $order = $this->getOrder($user, $request->order);
        if( $order == false){
          return json_encode("you did nt have this order");

      }else{
        if ($order->status == 'WaitingForUserConfirmation'){
          if($request->status == 'Canceled' || $request->status == 'Confirmed' ){
          $order->update([
              'status' => $request->status ? $request->status : $order->status,
          ]);
          return new OrderResource(Order::where('id',$request->order)->get());
        }
          return json_encode("You can't update your status now!");
        }
          return json_encode("You can't update your status now!");
      }
          return json_encode("Your are not valid");
    }
  }

      public function store(Request $request)
      {
          $user = $this->getUser();
          if($user){

           $order = $this->storeOrder($request);
           if (!$order){
             return json_encode("Your can't create order now!");
           }
          foreach (range(1, ($request->number)) as $i) {
              $medicine = $this->storeMedicine($request, $i);
              if($medicine == false){ return json_encode("This medicine is unavailable!");}

              OrderMedicine::create([
                'order_id' => $order->id,
                'medicine_id' => $medicine->id,
                'price' => 0,
                'quantity' => $request->input('quantity'.$i),
              ]);
          }

        }else{
          return json_encode("Your are not valid");
        }
      }

      private function storeOrder($request){

        $client = $this->getUser();
        $address = Address::where('user_id', $client->id)->where('is_main', 1)->first();

        if(!isset($address) || empty($address)){
            return false;
        }

        return Order::create([
            'delivering_address' => $address ? $address->id : "user address is unavailable",
            'created_by' => 'User',
            'status'=>  'New',
            'user_id'=> $client->id,
            ]);
        }


      private function storeMedicine($request, $i){
        $medicine = Medicine::where('name', $request->input('name'.$i))->first();

        if(!$medicine){
            return false;
          }else{
            return $medicine;
          }
        }


      private function getUser(){
        $client = auth()->user();
        if(isset($client) || !empty($client)) {
          return Client::find($client->profile_id);
        }else{
        return false;
        }
      }

    private function getOrder($user, $order_id){

      $client_orders = Order::where('user_id',$user->id)->get();

      if($client_orders->first() == null){
        return false;
      }else{
        $order = $client_orders->where('id',$order_id)->first();
        if($order == null){
          return false;
        }else{
          return $order;
        }
    }
  }

  }
