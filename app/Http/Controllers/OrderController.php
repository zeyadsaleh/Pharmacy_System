<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Order;

class OrderController extends Controller
{


  public function index(Request $request)
  {

      // if ($request->ajax()) {

          $data = Order::latest()->get();
          // dd($data);

          return Datatables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function($row){

                         $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                         $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                          return $btn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
      // }

      return view('orders.index');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */


    public function store(Request $request)
    {
      Order::updateOrCreate(['id' => $request->product_id],
              ['name' => $request->name, 'detail' => $request->detail]);

      return response()->json(['success'=>'Product saved successfully.']);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Product  $product
    * @return \Illuminate\Http\Response
    */


    public function edit($id)
    {
      $product = Product::find($id);
      return response()->json($product);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
      Product::find($id)->delete();

      return response()->json(['success'=>'Product deleted successfully.']);
    }

    public function show(){

    }

    public function update(){

    }

}
