<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use App\Doctor;
use App\User;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Order;

class PharmacyController extends Controller
{
    public function index()
    {
        return view('Pharmacy.index');
    }

    public function indexDoctors(Request $request)
    {
        return view('Pharmacy.Doctors.index');
    }


    public function createDoctors()
    {
        return view('Pharmacy.Doctors.create');
    }

    public function storeDoctors(DoctorRequest $request)
    {

        $validatedData = $request->validated();
        $validatedData['pharmacy_id'] = 1; //@TOBECHANGED

        if($request->hasfile('avatar'))
        {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;

            Storage::disk('public')->put('avatars/'.$filename, File::get($file));
        } else {
            $filename = 'doctor.jpeg';
        }

        // First slash is for concatenation with url of blade in ajax
        $validatedData['avatar'] = '/'.$filename;

        $user = User::create([
            // 'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        $doctor = Doctor::create([
            'name' => $validatedData['name'],
            'national_id' => $validatedData['national_id'],
            'avatar' => $validatedData['avatar'],
            'pharmacy_id' => $validatedData['pharmacy_id']
        ]);

        // $role = Role::create(['name' => 'doctor']);

        $user->assignRole('doctor');

        $doctor->user()->save($user);

        return redirect()->route('pharmacies.doctors.index');
    }
    


    public function update(DoctorRequest $request) {

        if($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            Storage::disk('public')->put('avatars/'.$filename, File::get($file));

        } else {
            $filename = 'doctor.jpeg';
        }

        $doctor = Doctor::find($request->doctor);

        $doctor->update([
            'name' => $request->name,
            'national_id' => $request->national_id,
            'avatar' => '/avatars/'.$filename,
        ]);

        $doctor->user()->update([
            // 'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pharmacies.doctors.index');
    }

    public function edit(Request $request) {
        $doctor = Doctor::find($request->doctor);

        $doctor['email'] = $doctor->user->email;
        $doctor['password'] = $doctor->user->password; //@TOBECHANGED

        return view('Pharmacy.Doctors.edit', [
            'doctor' => $doctor
        ]);
    }

    public function delete() {
        $doctor = Doctor::find(request()->doctor);
        $doctor->user()->delete();
        $doctor->delete();

        return redirect()->route('pharmacies.doctors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function ban(Request $request)
    {

        if(!empty($request->doctor)){
            $doctor = Doctor::find($request->doctor);
            $doctor->bans()->create([
                'comment'=>$request->baninfo
            ]);

            $doctor->update([
                'is_ban' => true
            ]);
        }

        return redirect()->route('pharmacies.doctors.index')->with('success','Ban Successfully..');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function unban(Request $request)
    {
        if(!empty($request->doctor)){
            $doctor = Doctor::find($request->doctor);
            $doctor->unban();

            $doctor->update([
                'is_ban' => false
            ]);
        }

        return redirect()->route('pharmacies.doctors.index')
        				->with('success','User Unbanned Successfully.');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctorsData()
    {
        return Datatables::of(DoctorResource::collection(Doctor::all()))->make(true);
    }

}
