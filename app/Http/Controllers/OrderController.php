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
        $order = $this->storeOrder($request);
        for($i=1; $i<=$request->items ; $i++){
          $medicine = $this->storeMedicine($request, $i);

          OrderMedicine::create([
            'order_id' => $order->id,
            'medicine_id' => $medicine->id,
            'price' => number_format($request->input('price'.$i),2,'.',''),
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

      $client = Client::where('name', $request->user)->first();
      $address = Address::where('user_id', $client->id)->where('is_main', 1)->first();
      $user = Auth::User();

      if($user->hasRole('Pharmacy')){
        $pharmacy = $user->profile;
        $created_by = 'Pharmacy';
      }else if($user->hasRole('Doctor')){
        $doctor = $user->profile;
        $pharmacy = $doctor->pharmacy;
        $created_by = 'Doctor';
      }else{
        $pharmacies = Pharmacy::where('area_id',$address->area_id);
        $pharmacy = $pharmacies->orderBy('priority', 'desc')->first();
        $created_by = 'User';
      }

      if($request->items>0){
        $total_price = 0;
        for($i=1; $i<=$request->items ; $i++){
          $total_price += (number_format($request->input('price'.$i)*$request->input('quantity'.$i), 2, '.', ''));
        }
      }
      // dd($address);
      return Order::create([
          'delivering_address' => $address ? $address->id : null,
          'created_by' => $created_by,
          'status'=> 'New',
          'pharmacy_id' => isset($pharmacy) ? $pharmacy->id: null,
          'user_id'=> $client->id,
          'doctor_id'=> isset($doctor) ? $doctor->id: null,
          'total_price' => $total_price,
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
