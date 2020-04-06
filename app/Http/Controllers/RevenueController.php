<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Order;

use App\Pharmacy;
use Illuminate\Support\Facades\Auth;
use App\User;
use Yajra\Datatables\Datatables;

use App\Http\Resources\OrderResource;



class RevenueController extends Controller
{
    public function index(Request $request)
    {
    //   1-  $pharmaserowner = User::create(['name'=>'Lilac Cottage','national_id'=>'123dxxd45','area_id'=>'1','email'=>$request->user->email,'password'=>'12dxxd345']);
    //   2-  $pharamacy = Pharmacy::create(['name'=>'Lilac Cottage','national_id'=>'123dxxd45','area_id'=>'1','email'=>$request->user->email,'password'=>'12dxxd345']);
    //   3-  $pharmcy->user()->save($user);
        // @dd(Datatables::of(OrderResource::collection(Order::all()))->make(true));
        $user = Auth::User();
        // if the user is pharamcy
        // if ($user->hasRole('pharmacy')) {
        //$revenue = $this->calculatePharmacyRevene();
        //if the user is admin
        // } elseif ($user->hasRole('admin')) {
            $revenue = $this->calculateAdminRevene($request);
        // }

        return view('Revenue.index', $revenue);
    }

    public function calculatePharmacyRevene()
    {
        //get the pharmacy object
        // $pharmacy = Auth::User()->profile->id;
        // $doctor->user->email;
        // @dd($pharmacy);
        //pharmacy_id by the polimerphic function profile
        $pharmacy_id = Auth::User()->profile->id;
        //query to find the revenue     
        $revenue = Order::where('pharmacy_id', 1)->sum('total_price'); // execute the query
        return [
            'revenue' => $revenue,
            'pharmacy' => Auth::User()->profile
        ];
    }

    public function calculateAdminRevene($request)
    {

        if ($request->ajax()) {
            return Datatables::of(OrderResource::collection(Order::all()))->make(true);
          }
        $pharmacy = Auth::User()->profile;
        // $bottle= Order::select(
        //     'name',
        //     'type',
        //     'location'            
        //   )->where(function($query) {
        //     $query->where('location','=','USA')->OrWhere('location','=',' ');
        //   });

        //   return DataTables::of($bottle)->make(true);

    }
}
