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
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
          return json_encode(['msg' => "you did nt have this order ".$request->order]);
      }else{
        return new OrderResource($order);
      }
      }else{
        return json_encode(['msg' => "Your are not valid"]);
      }
    }


    public function update(Request $request)
    {
      $request->validate([
          'status' => 'required',
          'prescriptions' => 'nullable|mimes:jpeg,bmp,png',
      ]);

      $user = $this->getUser();

      if($user){
        $order = $this->getOrder($user, $request->order);
      if( $order == false){
          return json_encode("you didnt have this order ".$request->order);
      }else{

        if ($order->status == 'WaitingForUserConfirmation'){
          if($request->status == 'Canceled' || $request->status == 'Confirmed' ){

            if($request->prescriptions != null){
                $file = $request->file('prescriptions');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('prescriptions/', $filename);
          }
            $order->update([
                'status' => $request->prescriptions ?  'New' : $request->status,
                'prescriptions' => $filename ? $filename : $order->$request->prescriptions,
            ]);

            $medicine = Medicine::where('name', $request->input('name'.$i))->first();


            return new OrderResource(Order::where('id',$request->order)->get());
        }
          return json_encode(['msg' => "you can set it to Canceled or Confirmed only, you cant set it to ".$request->status]);
        }
          return json_encode(['msg' => "you can set it under status WaitingForUserConfirmation only, your current status under: ".$order->status]);
      }
          return json_encode(['msg' => "Your are not valid"]);
    }
  }

      public function store(Request $request)
      {
          $client = $this->getUser();
          if($client){

            $request->validate([
              'prescriptions' => 'required|mimes:jpeg,bmp,png',
            ]);

            $file = $request->file('prescriptions');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('prescriptions/', $filename);
            // dd(time());

           $address = Address::where('user_id', $client->id)->where('is_main', 1)->first();
             if(!isset($address) || empty($address)){
               return json_encode(['msg' => "you didnt have main address yet, to deliver the order!"]);
             }
          $order = Order::create([
                       'delivering_address' => $address ? $address->id : "user address is unavailable",
                       'created_by' => 'User',
                       'status'=>  'New',
                       'user_id'=> $client->id,
                       'prescriptions' => $filename,
                       ]);
          return json_encode(['msg' => "order Created Successfully, you order_id  = ( ".$order->id." )"]);
        }else{
          return json_encode(['msg' => "Your are not valid"]);
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
