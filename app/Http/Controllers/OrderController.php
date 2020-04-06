<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Order;
use App\User;
use App\Address;
use App\Medicine;
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
      $address = Address::where('user_id', $request->user)->where('is_main', 1)->first();
      // dd($address);

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


    // private function autoComp($name){
    //   $data = Medicine::where('name', 'LIKE', $name.'%')->get();
    //   $output = '';
    //   $break = 0;
    //   if (count($data)>0) {
    //       foreach ($data as $row){
    //           $output .= '<span class="d-inlne p-2 ml-2 border border-dark rounded bg-success">'.$row->name.'</span>';
    //           $break++;
    //           if($break >= 4){break;}}
    //   }else {
    //       $output .= '<span class="d-inlne p-2 ml-2 border border-dark rounded bg-danger">'.'No results'.'</span>';
    //   }
    //   return $output;
    // }
}
