<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Client;
use App\Address;
use App\Medicine;
use App\Doctor;
use App\Pharmacy;
use App\OrderMedicine;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{


    public function index(Request $request)
    {
      $user = Auth::User();

      if ($request->ajax()) {
          if($user->hasrole('super-admin')){
            return Datatables::of(OrderResource::collection(Order::all()))->make(true);
          }elseif($user->hasrole('pharmacy')){
            $pharmacy_id = $user->profile->id;
            $orders = Order::where('pharmacy_id', $pharmacy_id)->get();
            return Datatables::of(OrderResource::collection($orders))->make(true);
          }
          // $orders = Order::where('pharmacy_id', 6)->get();
          // return Datatables::of(OrderResource::collection($orders))->make(true);
      }
        return view('orders.index');
    }


    public function create(Request $request){
      return view('orders.create', ['clients' => Client::all(), 'medicines' => Medicine::all()]);
    }


    public function store(Request $request)
    {
        $user = Auth::User();
        if(isset($user) || !empty($user)){

         $order = $this->storeOrder($request);

         if (!$order){
           return redirect()->route('orders.create')->with('danger','This user didnt has main address!');
         }
        foreach (range(1, 15) as $i) {
            if( $request->input('quantity'.$i) == null ){ break;}

            $medicine = $this->storeMedicine($request, $i);

            OrderMedicine::create([
              'order_id' => $order->id,
              'medicine_id' => $medicine->id,
              'price' => number_format($request->input('price'.$i),2,'.',''),
              'quantity' => $request->input('quantity'.$i),
            ]);
        }
        return view('orders.index');
      }else{
        return redirect()->route('orders.index')->with('danger','Permission denied!');
      }
    }


    public function edit(Request $request)
    {
      $user = Auth::User();
      if(isset($user) || !empty($user)){

        return view('orders.edit',[
              'order' => Order::find($request->order), 'pharmacies' => Pharmacy::all(), 'check' => 'readonly'
            ]);
            if($user->hasrole('super-admin')){
        }else{
          return view('orders.edit',[
              'order' => Order::find($request->order), 'check' => 'readonly'
          ]);
        }
        }else{
          return redirect()->route('orders.index')->with('danger','Permission denied!');
        }
      }


    public function update(Request $request){
      $user = Auth::User();

      if(isset($user) || !empty($user)){
        $order = Order::find($request->order);
        $order->update([
          'pharmacy_id' => $request->pharmacy ? $request->pharmacy : $order->pharmacy->id,
          'status' => $request->status ? $request->status : $order->status,
        ]);
        return redirect()->route('orders.index')->with('success','Order Updated successfully!');
      }else{
        return redirect()->route('orders.index')->with('danger','Order not allowed to Updated!');
      }
    }



    public function destroy(Request $request)
    {
      OrderMedicine::where('order_id', $request->order)->delete();
      Order::find($request->order)->delete();
      return redirect()->back()->with('warning','Order Deleted successfully!');
    }


    public function show(Request $request){
        return view('orders.show',[
            'order' => Order::find($request->order)
        ]);
    }


    private function storeOrder($request){

      $client = Client::where('name', $request->user)->first();
      $address = Address::where('user_id', $client->id)->where('is_main', 1)->first();

      if(!isset($address) || !empty($address)){
          return false;
      }
      $user = Auth::User();
      if(isset($user) || !empty($user)){
          if($user->hasrole('pharmacy')){
            $pharmacy = $user->profile;
            $created_by = 'Pharmacy';
          }else if($user->hasrole('doctor')){
            $doctor = $user->profile;
            $pharmacy = $doctor->pharmacy;
            $created_by = 'Doctor';
          }else{
            $pharmacies = Pharmacy::where('area_id',$address->area_id);
            if(isset($pharmacies)){
                $pharmacy = $pharmacies->sortBy('priority')->first();
              }
            $created_by = 'User';
      }
    }

      $prices = 0;
      foreach (range(1, 15) as $i) {
          if( $request->input('quantity'.$i) == null || $request->input('price'.$i) == null ){ break;}
          $prices += $request->input('price'.$i)*$request->input('quantity'.$i);
        }
        $total_price = (number_format($prices*100, 2, '.',''));

      return Order::create([
          'delivering_address' => $address ? $address->id : "user address is unavailable",
          'created_by' => $created_by,
          'status'=> 'WaitingForUserConfirmation',
          'pharmacy_id' => isset($pharmacy) ? $pharmacy->id: null,
          'user_id'=> $client->id,
          'doctor_id'=> isset($doctor) ? $doctor->id: null,
          'total_price' => $total_price ? $total_price : 0,
          ]);
}


    private function storeMedicine($request, $i){
      $medicine = Medicine::where('name', $request->input('medicine'.$i))->where('name', $request->input('type'.$i))->first();
      if(!$medicine && $medicine != 'Select Medicine'){
        return Medicine::create([
          'name' => $request->input('medicine'.$i),
          'type' => $request->input('type'.$i),
          ]);
        }else{
          return $medicine;
        }
      }

}
