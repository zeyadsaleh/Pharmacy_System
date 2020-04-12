<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Doctor;
use App\User;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Resources\DeletedPharmacyResource;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\pharmacyResource;
use App\Order;
use App\OrderMedicine;
use App\Pharmacy;
use Illuminate\Support\Facades\Auth;
// 

class PharmacyController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::User();
        if ($user->hasRole('pharmacy')) {
            $pharmacyUser = User::find(auth()->user()->id);
            $pharmacy = $pharmacyUser->profile;

            return view('index', [
                'pharmacy' => $pharmacy,
                'user' => $pharmacyUser
            ]);
        } elseif ($user->hasRole('super-admin')) {
            if ($request->ajax()) {
                return Datatables::of(pharmacyResource::collection(Pharmacy::all()))
                    ->make(true);
            }
            return view('Pharmacy.index');
        } else {
            return view('layouts.404');
        }
    }

    ## Admin Role

    public function create()
    {
        $user = Auth::User();
        if ($user->hasRole('super-admin')) {
            return view('Pharmacy.create', [
                'areas' => Area::all()
            ]);
        } else {
            return view('layouts.404');
        }
    }

    public function store(StorePharmacyRequest $request)
    {
        $user = Auth::User();
        if ($user->hasRole('super-admin')) {
            $validatedData = $request->validated();

            if ($request->hasfile('avatar')) {
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;

                $file->move('avatars/', $filename);
            } else {
                $filename = 'doctor.jpeg';
            }

            $validatedData['avatar'] = '/' . $filename;

            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password'])
            ]);

            $pharmacy = Pharmacy::create([
                'name' => $validatedData['name'],
                'national_id' => $validatedData['national_id'],
                'avatar' => $validatedData['avatar'],
                'priority' => $validatedData['priority'],
                'area_id' => $validatedData['area_id']
            ]);

            $user->assignRole('pharmacy');

            $pharmacy->user()->save($user);

            return redirect()->route('pharmacies.index');
        } else {
            return view('layouts.404');
        }
    }

    public function update(StorePharmacyRequest $request)
    {
        $user = Auth::User();
        if ($user->hasAnyRole(['super-admin', 'pharmacy'])) {
            if ($request->hasfile('avatar')) {
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $file->move('avatars/', $filename);
            } else {
                $filename = 'doctor.jpeg';
            }

            $pharmacy = Pharmacy::find($request->pharmacy);

            $pharmacy->update([
                'name' => $request->name,
                'national_id' => $request->national_id,
                'avatar' =>  '/' . $filename,
                'area_id' => $request->area_id ? $request->area_id : $pharmacy->area_id,
                'priority' => $request->priority ? $request->priority : $pharmacy->priority
            ]);

            $pharmacy->user()->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('pharmacies.index');
            // if (auth()->user()->hasRole('super-admin'))
            //     return redirect()->route('pharmacies.index');
            // else if (auth()->user()->hasRole('pharmacy'))
            //     return redirect()->route('pharmacies.index');
        } else {
            return view('layouts.404');
        }
    }

    public function edit(Request $request)
    {
        $user = Auth::User();
        if ($user->hasRole('super-admin')) {
            $pharmacy = Pharmacy::find($request->pharmacy);

            $pharmacy['email'] = $pharmacy->user->email;
            $pharmacy['password'] = $pharmacy->user->password; //@TOBECHANGED

            return view('Pharmacy.edit', [
                'pharmacy' => $pharmacy,
                'areas' => Area::all()
            ]);
        } else {
            return view('layouts.404');
        }
    }

    public function destroy(Request $request)
    {
        $user = Auth::User();
        if ($user->hasRole('super-admin')) {
            $orders = Order::where('pharmacy_id', $request->pharmacy)->get();

            foreach ($orders as $order) {
                if ($order->status != 'Canceled' || !$order->status != 'Delivered') {
                    return redirect()->route('pharmacies.index')->with('danger', 'Pharmacy has assigned Orders, cant delete it!');;
                }
            }
            OrderMedicine::where('order_id', $request->order)->delete();
            Order::where('pharmacy_id', $request->pharmacy)->delete();
            Pharmacy::where('id', $request->pharmacy)->delete();
            return redirect()->route('pharmacies.index')->with('success', 'Pharmacy Deleted successfully!');
        } else {
            return view('layouts.404');
        }
    }
    public function restore($pharmacy)
    {
        Pharmacy::withTrashed()
            ->where('id', $pharmacy)
            ->restore();

        return view('Pharmacy.deleted.index');
    }
    public function indexDeleted(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(DeletedPharmacyResource::collection(Pharmacy::onlyTrashed()->get()))
                ->make(true);
        }
        return view('Pharmacy.deleted.index');
    }
}


  // public function indexDoctors(Request $request)
    // {
    //     return view('Pharmacy.Doctors.index');
    // }


    // public function createDoctors()
    // {
    //     return view('Pharmacy.Doctors.create', [
    //         'pharmacies' => Pharmacy::all()
    //     ]);
    // }

    // public function storeDoctors(DoctorRequest $request)
    // {

    //     $validatedData = $request->validated();

    //     if ($request->hasfile('avatar')) {
    //         $file = $request->file('avatar');
    //         $extension = $file->getClientOriginalExtension(); // getting image extension
    //         $filename = time() . '.' . $extension;

    //         $file->move('avatars/', $filename);
    //     } else {
    //         $filename = 'doctor.jpeg';
    //     }

    //     // First slash is for concatenation with url of blade in ajax
    //     $validatedData['avatar'] = '/' . $filename;

    //     $user = User::create([
    //         'email' => $validatedData['email'],
    //         'password' => Hash::make($validatedData['password'])
    //     ]);

    //     $doctor = Doctor::create([
    //         'name' => $validatedData['name'],
    //         'national_id' => $validatedData['national_id'],
    //         'avatar' => $validatedData['avatar'],
    //         'pharmacy_id' => $request->pharmacy_id ? $request->pharmacy_id : auth()->user()->profile->id
    //     ]);

    //     $user->assignRole('doctor');

    //     $doctor->user()->save($user);

    //     return redirect()->route('pharmacies.doctors.index');
    // }



    // public function updateDoctors(DoctorRequest $request)
    // {

    //     if ($request->hasfile('avatar')) {
    //         $file = $request->file('avatar');
    //         $extension = $file->getClientOriginalExtension(); // getting image extension
    //         $filename = time() . '.' . $extension;
    //         $file->move('avatars/', $filename);
    //     } else {
    //         $filename = 'doctor.jpeg';
    //     }

    //     $doctor = Doctor::find($request->doctor);

    //     $doctor->update([
    //         'name' => $request->name,
    //         'national_id' => $request->national_id,
    //         'avatar' => '/' . $filename,
    //         'pharmacy_id' => $request->pharmacy_id ? $request->pharmacy_id : $doctor->pharmacy_id
    //     ]);

    //     $doctor->user()->update([
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return redirect()->route('pharmacies.doctors.index');
    // }

    // public function editDoctors(Request $request)
    // {
    //     $doctor = Doctor::find($request->doctor);

    //     $doctor['email'] = $doctor->user->email;
    //     $doctor['password'] = $doctor->user->password; //@TOBECHANGED

    //     return view('Pharmacy.Doctors.edit', [
    //         'doctor' => $doctor
    //     ]);
    // }

    // public function deleteDoctors()
    // {
    //     $doctor = Doctor::find(request()->doctor);
    //     $doctor->user()->delete();
    //     $doctor->delete();

    //     return redirect()->route('pharmacies.doctors.index');
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return Response
    //  */
    // public function banDoctors(Request $request)
    // {

    //     if (!empty($request->doctor)) {
    //         $doctor = Doctor::find($request->doctor);
    //         $doctor->bans()->create([
    //             'comment' => $request->baninfo
    //         ]);

    //         $doctor->update([
    //             'is_ban' => true
    //         ]);
    //     }

    //     return redirect()->route('pharmacies.doctors.index')->with('success', 'Ban Successfully..');
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return Response
    //  */
    // public function unbanDoctors(Request $request)
    // {
    //     if (!empty($request->doctor)) {
    //         $doctor = Doctor::find($request->doctor);
    //         $doctor->unban();

    //         $doctor->update([
    //             'is_ban' => false
    //         ]);
    //     }

    //     return redirect()->route('pharmacies.doctors.index')
    //         ->with('success', 'User Unbanned Successfully.');
    // }

    // /**
    //  * Process datatables ajax request.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function doctorsData()
    // {
    //     if (auth()->user()->hasRole('super-admin|admin'))
    //         return Datatables::of(DoctorResource::collection(Doctor::all()))->make(true);
    //     else if (auth()->user()->hasRole('pharmacy'))
    //         return Datatables::of(DoctorResource::collection(
    //             Doctor::where('pharmacy_id', auth()->user()->profile_id)->get()
    //         ))->make(true);
    // }
