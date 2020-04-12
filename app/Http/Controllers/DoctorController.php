<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Doctor;
use Yajra\Datatables\Datatables;


use App\Area;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\User;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Resources\DeletedPharmacyResource;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\pharmacyResource;
use App\Order;
use App\OrderMedicine;
use App\Pharmacy;


class DoctorController extends Controller
{

    public function index()
    {
        $user = Auth::User();
        if ($user->hasRole('doctor')) {
            $doctor = Doctor::find($user->profile->id);
            return view('index', ['doctor' => $doctor, 'user' => $user]);
        } elseif ($user->hasAnyRole(['pharmacy', 'super-admin'])) {
            return view('doctor.index');
        } else {
            return view('layouts.404');
        }
    }


    public function create()
    {
        $user = Auth::User();
        if ($user->hasAnyRole(['pharmacy', 'super-admin'])) {
            return view('doctor.create', [
                'pharmacies' => Pharmacy::all()
            ]);
        } else {
            return view('layouts.404');
        }
    }

    public function store(DoctorRequest $request)
    {
        $user = Auth::User();
        if ($user->hasAnyRole(['pharmacy', 'super-admin'])) {

            $validatedData = $request->validated();
            if ($request->hasfile('avatar')) {
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;

                $file->move('avatars/', $filename);
            } else {
                $filename = 'doctor.jpeg';
            }

            // First slash is for concatenation with url of blade in ajax
            $validatedData['avatar'] = '/' . $filename;

            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password'])
            ]);

            $doctor = Doctor::create([
                'name' => $validatedData['name'],
                'national_id' => $validatedData['national_id'],
                'avatar' => $validatedData['avatar'],
                'pharmacy_id' => $request->pharmacy_id ? $request->pharmacy_id : auth()->user()->profile->id
            ]);

            $user->assignRole('doctor');

            $doctor->user()->save($user);

            return redirect()->route('doctor.index');
        } else {
            return view('layouts.404');
        }
    }



    public function update(DoctorRequest $request)
    {
        $user = Auth::User();
        if ($user->hasAnyRole(['pharmacy', 'super-admin'])) {

            if ($request->hasfile('avatar')) {
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $file->move('avatars/', $filename);
            } else {
                $filename = 'doctor.jpeg';
            }

            $doctor = Doctor::find($request->doctor);

            $doctor->update([
                'name' => $request->name,
                'national_id' => $request->national_id,
                'avatar' => '/' . $filename,
                'pharmacy_id' => $request->pharmacy_id ? $request->pharmacy_id : $doctor->pharmacy_id
            ]);

            $doctor->user()->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('doctor.index');
        } else {
            return view('layouts.404');
        }
    }

    public function edit(Request $request)
    {
        $user = Auth::User();
        if ($user->hasAnyRole(['pharmacy', 'super-admin'])) {
            $doctor = Doctor::find($request->doctor);

            $doctor['email'] = $doctor->user->email;
            $doctor['password'] = $doctor->user->password; //@TOBECHANGED

            return view('doctors.edit', [
                'doctor' => $doctor
            ]);
        } else {
            $filename = 'doctor.jpeg';
        }
    }

    public function destroy()
    {
        $user = Auth::User();
        if ($user->hasAnyRole(['pharmacy', 'super-admin'])) {
            $doctor = Doctor::find(request()->doctor);
            $doctor->user()->delete();
            $doctor->delete();

            return redirect()->route('doctor.index');
        } else {
            return view('layouts.404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function banDoctors(Request $request)
    {

        if (!empty($request->doctor)) {
            $doctor = Doctor::find($request->doctor);
            $doctor->bans()->create([
                'comment' => $request->baninfo
            ]);

            $doctor->update([
                'is_ban' => true
            ]);
        }

        return redirect()->route('doctor.index')->with('success', 'Ban Successfully..');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function unbanDoctors(Request $request)
    {
        if (!empty($request->doctor)) {
            $doctor = Doctor::find($request->doctor);
            $doctor->unban();

            $doctor->update([
                'is_ban' => false
            ]);
        }

        return redirect()->route('doctors.index')
            ->with('success', 'User Unbanned Successfully.');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctorsData()
    {
        if (auth()->user()->hasRole('super-admin|admin'))
            return Datatables::of(DoctorResource::collection(Doctor::all()))->make(true);
        else if (auth()->user()->hasRole('pharmacy'))
            return Datatables::of(DoctorResource::collection(
                Doctor::where('pharmacy_id', auth()->user()->profile_id)->get()
            ))->make(true);
    }
}
