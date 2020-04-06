<?php

namespace App\Http\Controllers;

use App\Address;
use App\Area;
use App\Doctor;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\admin\StoreAreaRequest;
use App\Http\Requests\admin\StoreUserRequest;
use App\Pharmacy;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.index');
    }
    public function indexDoctors(Request $request)
    {
        if ($request->ajax()) {
            $data = Doctor::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a type="button" name="edit" href="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $button;
                })
                ->addColumn('pharmacy', function ($data) {
                    return  Pharmacy::find($data->pharmacy_id)->name;
                })
                ->rawColumns(['action', 'pharmacy'])
                ->make(true);
        }
        return view('admin.doctors.index');
    }
    public function createDoctor()
    {
        $pharmacies = Pharmacy::all();
        return view('admin.doctors.create', [
            'pharmacies' => $pharmacies,
        ]);
    }

    public function storeDoctor(DoctorRequest $request)
    {
        Doctor::create($request->validated());
        return redirect()->route('admin.doctors.index');
    }

    public function indexArea(Request $request)
    {
        if ($request->ajax()) {
            $area = Area::all();
            return DataTables::of($area)
            ->addColumn('action', function ($area) {
                $button = '<a type="button" name="edit" href="areas/' . $area->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                $button .= "&nbsp;&nbsp;&nbsp";
                $button .= "<form method='POST' id='delete-$area->id' class='d-inline' action=".route('admin.areas.destroy', ['area' => $area->id])."><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='_method' value='DELETE'>";
                $button .= "<button type='button' onclick='deleteArea($area->id)' data-id='$area->id' class='btn mx-1 btn-danger btn-sm'>Delete</button></form>";
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.areas.index');
    }
    public function createArea()
    {
        return view('admin.areas.create');
    }

    public function storeArea(StoreAreaRequest $request)
    {
        Area::create($request->validated());
        return redirect()->route('admin.areas.index');
    }

    public function editArea(Request $request) {
        $area = Area::find($request->area);
        return view('admin.areas.edit', [
            'area' => $area
        ]);
    }
    public function updateArea(Request $request) {
        Area::where('id', $request->area)->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.areas.index');
    }

    public function destroyArea() {
        Area::where('id', request()->area)->delete();
        return redirect()->route('admin.areas.index');
    }

    ### Users

    public function indexUser(Request $request)
    {

        if ($request->ajax()) {
            $users = User::all();
            return DataTables::of($users)
            ->addColumn('action', function ($users) {
                $button = '<a type="button" name="edit" href="users/' . $users->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                $button .= "&nbsp;&nbsp;&nbsp";
                $button .= "<form method='POST' id='delete-$users->id' class='d-inline' action=".route('admin.users.destroy', ['user' => $users->id])."><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='_method' value='DELETE'>";
                $button .= "<button type='button' onclick='deleteArea($users->id)' data-id='$users->id' class='btn mx-1 btn-danger btn-sm'>Delete</button></form>";
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.users.index');
    }
    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(StoreUserRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('admin.users.index');
    }

    public function editUser(Request $request) {
        $user = User::find($request->user);
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }
    public function updateUser(Request $request) {
        User::where('id', $request->user)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.users.index');
    }

    public function destroyUser() {
        User::where('id', request()->user)->delete();
        return redirect()->route('admin.users.index');
    }

    ##Pharmacy
    public function indexPharmacy(Request $request)
    {
        if ($request->ajax()) {
            $pharmacies = Pharmacy::all();
            return DataTables::of($pharmacies)
            ->addColumn('action', function ($pharmacies) {
                $button = '<a type="button" name="edit" href="users/' . $pharmacies->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                $button .= "&nbsp;&nbsp;&nbsp";
                $button .= "<form method='POST' id='delete-$pharmacies->id' class='d-inline' action=".route('admin.users.destroy', ['user' => $pharmacies->id])."><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='_method' value='DELETE'>";
                $button .= "<button type='button' onclick='deleteArea($pharmacies->id)' data-id='$pharmacies->id' class='btn mx-1 btn-danger btn-sm'>Delete</button></form>";
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.pharmacies.index');
    }
    public function createPharmacy()
    {
        return view('admin.pharmacies.create');
    }

    public function storePharmacy(StoreUserRequest $request)
    {
        Pharmacy::create($request->validated());
        return redirect()->route('admin.pharmacies.index');
    }

    public function editPharmacy(Request $request) {
        $pharamcy = Pharmacy::find($request->pharmacy);
        return view('admin.pharmacies.edit', [
            'pharamcy' => $pharamcy
        ]);
    }
    public function updatePharmacy(Request $request) {
        Pharmacy::where('id', $request->pharmacy)->update([
            'name' => $request->name,
            'address' => $request->adressd,
        ]);

        return redirect()->route('admin.pharmacies.index');
    }

    public function destroyPharmacy() {
        Pharmacy::where('id', request()->pharmacy)->delete();
        return redirect()->route('admin.pharmacies.index');
    }

    ##User Addresses
    public function indexUserAddress(Request $request)
    {
        if ($request->ajax()) {
            $userAddresses = Address::all();
            return DataTables::of($userAddresses)
            ->addColumn('action', function ($userAddresses) {
                $button = '<a type="button" name="edit" href="users/' . $userAddresses->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                $button .= "&nbsp;&nbsp;&nbsp";
                $button .= "<form method='POST' id='delete-$userAddresses->id' class='d-inline' action=".route('admin.users.destroy', ['user' => $userAddresses->id])."><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='_method' value='DELETE'>";
                $button .= "<button type='button' onclick='deleteArea($userAddresses->id)' data-id='$userAddresses->id' class='btn mx-1 btn-danger btn-sm'>Delete</button></form>";
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.userAddresses.index');
    }
    public function createUserAddress()
    {
        return view('admin.userAddresses.create');
    }

    public function storeUserAddress(StoreUserRequest $request)
    {
        Address::create($request->validated());
        return redirect()->route('admin.userAddresses.index');
    }

    public function editUserAddress(Request $request) {
        $userAddress = Address::find($request->address);
        return view('admin.userAddresses.edit', [
            'userAddress' => $userAddress
        ]);
    }
    public function updateUserAddress(Request $request) {
        Address::where('id', $request->address)->update([
            'name' => $request->name,
            'address' => $request->adressd,
        ]);

        return redirect()->route('admin.userAddresses.index');
    }

    public function destroyUserAddress() {
        Address::where('id', request()->address)->delete();
        return redirect()->route('admin.userAddresses.index');
    }




    // public function create(){
    //     if(true){
    //         $this->createUser();
    //     }
    //     else if(true){
    //         $this->createDoctor();
    //     }
    //     else if(true){
    //         $this->createDoctor();
    //     }
    //     else if(true){
    //         $this->createDoctor();
    //     }
    //     else{

    //     }
    // }
}




// $button .='<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-id="'.$area->id.'" data-target="'.$area->id.'>Delete</button>
//                 <div id="'.$area->id.'" class="modal fade" role="dialog">
//                 <div class="modal-dialog">
//                   <!-- Modal content-->
//                   <div class="modal-content">
//                     <div class="modal-header">
//                       <button type="button" class="close" data-dismiss="modal">&times;</button>
//                     </div>
//                     <div class="modal-body">
//                       <p>Be Carefull, you are about to delete this post</p>
//                     </div>
//                     <div class="modal-footer">
//                       <form method="POST" action="'.route('admin.areas.destroy', ['area' => $area->id]).'">
//                         @csrf
//                         <input type="hidden" name="_method" value="DELETE">
//                         <button type="submit" class="btn btn-primary">Yes, Delet
//                         e it</button>
//                       </form>
//                       <button type="button" class="btn btn-default" data-dismiss="modal">No, keep It</button>
//                     </div>
//                   </div>
//                 </div>
//                 </div>'
