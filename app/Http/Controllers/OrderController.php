<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('orders.index');
    }

    public function create(Request $request){
      // if($request->ajax()) {
      //   return $this->autoComp($request->medicine);
      // }
      return view('orders.create', ['users' => User::all(), 'medicines' => Medicine::all()]);
    }

    public function store(Request $request)
    {
      $medicines = $request->medicine;
      $user = $request->user;
      $address = Address::where('user_id', $request->user)->where('is_main', 1)->first();
      $medicine_id = $this->storeMedicine($request);
      dd($medicine_id);
      $order_id = $this->storeOrder($request);

      OrderMedicine::create([
        'title' => $request->title,
        'description' => $request->description,
        'category' => $request->category,
        'user_id' => $request->user_id,
        'image_id' => $image->id,
      ]);

      return redirect()->route('pharmacies.doctors.show');
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

    }
    
    private function storeMedicine($request){

      $medicine = Medicine::where('name', $request->medicine)->first();
      if(!$medicine){
        return OrderMedicine::create([
          'name' => $request->medicine,
          'type' => $request->type,
          ])->id;
        }else{
          return $medicine->id;
        }
    }

}
