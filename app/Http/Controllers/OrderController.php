<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Order;
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

    public function store(Request $request)
    {
      // Order::updateOrCreate(['id' => $request->order_id],
      //         ['name' => $request->name, 'detail' => $request->detail]);
      // return response()->json(['success'=>'order saved successfully.']);
    }


    public function edit(Request $request)
    {
      return view('orders.edit',[
          'order' => Order::find($request->order),
      ]);
    }

    public function destroy(Request $request)
    {
      Order::find($request->order)->delete();
      return redirect()->back()->with('warning','Order Deleted successfully!');;
    }

    public function show(){

    }

    public function update(Request $request){
      $order = Order::find($request->order);
      $order->fill($request->all())->save();
      return redirect()->route('orders.index')->with('success','Order Updated successfully!');
    }

  }
