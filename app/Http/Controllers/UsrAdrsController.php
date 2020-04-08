<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Http\Requests\StoreUsrAdrsRequest;
use App\Http\Resources\UsrAdrsResource;
use Yajra\DataTables\Facades\DataTables;


class UsrAdrsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('role:admin');

        // $this->middleware('auth');
        // $this->middleware('permission:edit articles')->only('testmiddleware');
        // $this->middleware('role:admin|writer')->only('testmiddleware');
    }
    //
     ##User Addresses
     public function index(Request $request)
     {
        if ($request->ajax()) {
            return Datatables::of(UsrAdrsResource::collection(Address::all()))->make(true);
        }
        return view('userAddresses.index');
     }
     public function create()
     {
         return view('userAddresses.create');
     }

     public function store(StoreUsrAdrsRequest $request)
     {
         Address::create($request->validated());
         return redirect()->route('admin.userAddresses.index');
     }

     public function edit(Request $request) {
         $userAddress = Address::find($request->address);
         return view('userAddresses.edit', [
             'userAddress' => $userAddress
         ]);
     }
     public function update(Request $request) {
         Address::where('id', $request->address)->update([
             'name' => $request->name,
             'address' => $request->adressd,
         ]);
         return redirect()->route('admin.userAddresses.index');
     }

     public function destroy() {
         Address::where('id', request()->address)->delete();
         return redirect()->route('admin.userAddresses.index');
     }
}
