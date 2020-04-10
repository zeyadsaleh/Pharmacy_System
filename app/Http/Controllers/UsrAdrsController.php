<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Client;
use App\Http\Requests\StoreUsrAdrsRequest;
use App\Http\Resources\UsrAdrsResource;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class UsrAdrsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin']);
    }

    ##User Addresses
    public function index(Request $request) #####need some fixes here
    {

        $addresses = DB::table('addresses')
            ->join('clients', 'addresses.user_id', '=', 'clients.id')
            ->select('addresses.*', 'clients.*')
            ->get();

        if ($request->ajax()) {
            return Datatables::of(UsrAdrsResource::collection($addresses))
            ->make(true);
        }
        return view('userAddresses.index');
    }
    public function create()
    {
        return view('userAddresses.create',[
            'users'=>Client::all(),
        ]);
    }

    public function store(StoreUsrAdrsRequest $request)
    {

        $validatedData = $request->validated();

        $address = Address::create([
            'street_name' => $validatedData['street_name'],
            'building_name' => $validatedData['building_name'],
            'floor_number' => $validatedData['floor_number'],
            'flat_number' => $validatedData['flat_number'],
            'is_main' => $request->is_main ? true : false,
            'user_id' => $validatedData['user_id']
        ]);

        return redirect()->route('admin.userAddresses.index');
    }

    public function edit(Request $request)
    {
        $userAddress = Address::find($request->useraddresss);
        $user = Client::find($userAddress->user_id);
        return view('userAddresses.edit', [
            'userAddress' => $userAddress,
            'user' => $user
        ]);
    }
    public function update(Request $request)
    {
        Address::where('id', $request->useraddress)->update([
            'street_name' => $request -> street,
            'building_name' => $request -> building,
            'floor_number' => $request -> floor,
            'flat_number' => $request -> flat,
            'is_main' => $request -> is_main ? true : false
        ]);
        return redirect()->route('admin.userAddresses.index');
    }

    public function destroy()
    {
        Address::where('id', request()->useraddress)->delete();
        return redirect()->route('admin.userAddresses.index');
    }
}
