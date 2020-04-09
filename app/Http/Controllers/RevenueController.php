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
use App\Http\Resources\RevenueResource;




class RevenueController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::User();
        if ($user->hasRole('pharmacy')) {
            $revenue = $this->calculatePharmacyRevene();
            return view('revenue.index', $revenue);
        } elseif ($user->hasRole('super-admin')) {
            if ($request->ajax()) {
                return $this->calculateAdminRevene();
            }
        }
        return view('revenue.index');
    }
    public function calculatePharmacyRevene()
    {
        //pharmacy_id by the polimerphic function profile
        $pharmacy_id = Auth::User()->profile->id;
        //query to find the revenue
        $revenue = Order::where('pharmacy_id', $pharmacy_id)->where('status', 'Delivered')->sum('total_price');
        return [
            'revenue' => $revenue,
            'pharmacy' => Auth::User()->profile
        ];
    }

    public function calculateAdminRevene()
    {
        $orders = DB::table('pharmacies')
            ->join('orders', 'orders.pharmacy_id', '=', 'pharmacies.id')
            ->select('pharmacies.name', 'pharmacies.avatar', DB::raw('SUM(total_price) as total_price'), DB::raw('count(pharmacy_id) as count'))
            ->groupBy('pharmacies.name', 'pharmacies.avatar')
            ->get();
        return Datatables::of(RevenueResource::collection($orders))->make(true);
    }
}
