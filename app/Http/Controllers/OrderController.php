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


    public function edit($id)
    {
      $order = Order::find($id);
      return response()->json($order);
    }

    public function destroy($id)
    {
      Order::find($id)->delete();
      return view('orders.index');
    }

    public function show(){

    }

    public function update(){

    }

  }
