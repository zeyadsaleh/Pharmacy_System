<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\MedicineRequest;
use Yajra\Datatables\Datatables;
use App\Order;
use App\User;
use App\Address;
use App\Medicine;
use App\OrderMedicine;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{ 


    public function index(Request $request)
    {
      if ($request->ajax()) {
          return Datatables::of(OrderResource::collection(Order::all()))->make(true);
        }
        // dd(Datatables::of(OrderResource::collection(Order::all()))->make(true));

        return view('orders.index');
    }

    public function create(Request $request){

      return view('orders.create', ['users' => User::all(), 'medicines' => Medicine::all()]);
    }

#########################################################
    public function store(Request $request)
    {

      $order = $this->storeOrder($request);

      for($i=1; $i<=$request->items ; $i++){

        $medicine = $this->storeMedicine($request, $i);

        // dd(($request->input('price'.$i)/100));

        OrderMedicine::create([
          'order_id' => $order->id,
          'medicine_id' => $medicine->id,
          'pharmacy_id' => null,
          'price' => ($request->input('price'.$i)/100),
          'quantity' => $request->input('quantity'.$i),
        ]);
    }

      return view('orders.index');
    }
####################################################

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

      $user = User::where('name', $request->user)->first();
      $address = Address::where('user_id', $user->id)->where('is_main', 1)->first();
      $total_price = (($request->quantity * $request->price)/100);
      // dd($address);
      return Order::create([
          'delivering_address' => $address ? $address->id : null,
          'is_insured' => $user->is_insured ? $user->is_insured: false,
          // 'is_insured' => 0,
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
          'price' => 100,
          ]);
        }else{
          return $medicine;
        }
    }

}
