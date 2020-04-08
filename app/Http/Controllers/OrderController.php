<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Client;
use App\Address;
use App\Medicine;
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
      if ($request->ajax()) {
          return Datatables::of(OrderResource::collection(Order::all()))->make(true);
        }
        return view('orders.index');
    }

    public function create(Request $request){
      return view('orders.create', ['users' => Client::all(), 'medicines' => Medicine::all()]);
    }

    public function store(Request $request)
    {
      // dd($request);
        $order = $this->storeOrder($request);
        for($i=1; $i<=$request->items ; $i++){
          $medicine = $this->storeMedicine($request, $i);
          OrderMedicine::create([
            'order_id' => $order->id,
            'medicine_id' => $medicine->id,
            'price' => ($request->input('price'.$i)/100),
            'quantity' => $request->input('quantity'.$i),
          ]);
        }
        return view('orders.index');
    }

    public function edit(Request $request)
    {
      return view('orders.edit',[
          'order' => Order::find($request->order),
      ]);
    }

    public function update(Request $request){
      Order::find($request->order)->fill($request->all())->save();
      return redirect()->route('orders.index')->with('success','Order Updated successfully!');
    }

    public function destroy(Request $request)
    {
      Order::find($request->order)->delete();
      return redirect()->back()->with('warning','Order Deleted successfully!');;
    }


    private function storeOrder($request){

      dd(Auth::User());
      $user = Client::where('name', $request->user)->first();
      $address = Address::where('user_id', $user->id)->where('is_main', 1)->first();
      $total_price = (($request->quantity * $request->price)/100);
      // dd($address);
      return Order::create([
          'delivering_address' => $address ? $address->id : null,
          'created_by' => 'Pharmacy',
          'status'=> 'New',
          'pharmacy_id' => null,
          'user_id'=> $user->id,
          'doctor_id'=> null,
          // 'total_price' => $total_price
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
    // private function detectUser($user){
    //   $user = Auth::User();
    //
    //   switch(true){
    //     case($user->hasRole('Client')):
                // return $user->profile->id:
    //     case($user->hasRole('Doctor')):
    //     case($user->hasRole('Pharmacy')):
    //     case($user->hasRole('Admin')):
    //
    //   }

}
