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
      return view('orders.create', ['clients' => Client::all(), 'medicines' => Medicine::all()]);
    }


    public function store(Request $request)
    {
        $order = $this->storeOrder($request);

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
      OrderMedicine::where('order_id', $request->order)->delete();
      Order::find($request->order)->delete();
      return redirect()->back()->with('warning','Order Deleted successfully!');;
    }


    public function show(Request $request){
        $order = Order::find($request->order)->first();
        $address = Address::where('id', $order->delivering_address)->first();
        return view('orders.show',[
            'order' => Order::find($request->order), 'address' => $address
        ]);
    }


    private function storeOrder($request){

      $client = Client::where('name', $request->user)->first();
      $address = Address::where('user_id', $client->id)->where('is_main', 1)->first();
      $user = Auth::User();

      if(isset($user)){

          if($user->hasrole('Pharmacy')){
            $pharmacy = $user->profile;
            $created_by = 'Pharmacy';
          }else if($user->hasrole('Doctor')){
            $doctor = $user->profile;
            $pharmacy = $doctor->pharmacy;
            $created_by = 'Doctor';
          }else{
            $pharmacies = Pharmacy::where('area_id',$address->area_id);
            $pharmacy = $pharmacies->orderBy('priority', 'asc')->first();
            $created_by = 'User';
          }
      }else{
        $pharmacies = Pharmacy::where('area_id',$address->area_id);
        $pharmacy = $pharmacies->orderBy('priority', 'asc')->first();
        $created_by = 'User';
      }

      $prices = 0;
      foreach (range(1, 15) as $i) {
          if( $request->input('quantity'.$i) == null || $request->input('price'.$i) == null ){ break;}
          $prices += (number_format($request->input('price'.$i)*$request->input('quantity'.$i), 2, '.', ''));
        }
        $total_price = (number_format($prices, 2, '.',''));

      return Order::create([
          'delivering_address' => $address ? $address->id : "user address is unavailable",
          'created_by' => $created_by,
          'status'=> 'Processing',
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
