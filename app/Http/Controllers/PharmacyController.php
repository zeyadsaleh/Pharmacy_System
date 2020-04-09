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
use App\Http\Resources\DoctorResource;
use App\Http\Resources\pharmacyResource;
use App\Order;
use App\Pharmacy;

class PharmacyController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $pharmacy = $user->profile;

        return view('index', [
            'pharmacy' => $pharmacy,
            'user' => $user
        ]);
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

        if ($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;

            Storage::disk('public')->put('avatars/' . $filename, File::get($file));
        } else {
            $filename = 'doctor.jpeg';
        }

        // First slash is for concatenation with url of blade in ajax
        $validatedData['avatar'] = '/' . $filename;

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

        $user->assignRole('doctor');

        $doctor->user()->save($user);

        return redirect()->route('pharmacies.doctors.index');
    }



    public function update(DoctorRequest $request)
    {

        if ($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            Storage::disk('public')->put('avatars/' . $filename, File::get($file));
        } else {
            $filename = 'doctor.jpeg';
        }

        $doctor = Doctor::find($request->doctor);

        $doctor->update([
            'name' => $request->name,
            'national_id' => $request->national_id,
            'avatar' => '/' . $filename,
        ]);

        $doctor->user()->update([
            // 'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pharmacies.doctors.index');
    }

    public function edit(Request $request)
    {
        $doctor = Doctor::find($request->doctor);

        $doctor['email'] = $doctor->user->email;
        $doctor['password'] = $doctor->user->password; //@TOBECHANGED

        return view('Pharmacy.Doctors.edit', [
            'doctor' => $doctor
        ]);
    }

    public function delete()
    {
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

        if (!empty($request->doctor)) {
            $doctor = Doctor::find($request->doctor);
            $doctor->bans()->create([
                'comment' => $request->baninfo
            ]);

            $doctor->update([
                'is_ban' => true
            ]);
        }

        return redirect()->route('pharmacies.doctors.index')->with('success', 'Ban Successfully..');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function unban(Request $request)
    {
        if (!empty($request->doctor)) {
            $doctor = Doctor::find($request->doctor);
            $doctor->unban();

            $doctor->update([
                'is_ban' => false
            ]);
        }

        return redirect()->route('pharmacies.doctors.index')
            ->with('success', 'User Unbanned Successfully.');
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



    ## Admin Role
    public function indexPh(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(pharmacyResource::collection(Pharmacy::all()))
                ->make(true);
        }
        return view('Pharmacy.index');
    }

    public function createPh()
    {
        return view('Pharmacy.create',[
            'areas'=> Area::all()
        ]);
    }

    public function storePh(StorePharmacyRequest $request)
    {
        $validatedData = $request->validated();

        // dd($validatedData['avatar']);

        if ($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;

            Storage::disk('public')->put('avatars/' . $filename, File::get($file));

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

        return redirect()->route('admin.pharmacies.index');
    }

    public function updatePh(StorePharmacyRequest $request)
    {
        if ($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            Storage::disk('public')->put('avatars/' . $filename, File::get($file));
        } else {
            $filename = 'doctor.jpeg';
        }

        $pharmacy = Pharmacy::find($request->pharmacy);

        $pharmacy->update([
            'name' => $request->name,
            'national_id' => $request->national_id,
            'avatar' =>  '/' . $filename,
            'area_id' => $request->area_id,
            'priority' => $request->priority
        ]);

        $pharmacy->user()->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.pharmacies.index');
    }

    public function editPh(Request $request)
    {
        $pharmacy = Pharmacy::find($request->pharmacy);

        $pharmacy['email'] = $pharmacy->user->email;
        $pharmacy['password'] = $pharmacy->user->password; //@TOBECHANGED

        return view('Pharmacy.edit', [
            'pharmacy' => $pharmacy,
            'areas'=> Area::all()
        ]);
    }

    public function destroyPh()
    {
        Pharmacy::where('id', request()->pharmacy)->delete();
        return redirect()->route('admin.pharmacies.index');
    }
}
