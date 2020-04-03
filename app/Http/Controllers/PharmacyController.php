<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Doctor;
use App\Http\Requests\DoctorRequest;

class PharmacyController extends Controller
{
    public function index() {
        return view('Pharmacy.Doctors.index');
    }

    public function showDoctors() {
        return view('Pharmacy.Doctors.show');
    }

    public function createDoctors() {
        return view('Pharmacy.Doctors.create');
    }

    public function storeDoctors(DoctorRequest $request) {

        $validatedData = $request->validated();
        $validatedData['pharmacy_id'] = 1;

        if($request->hasfile('avatar')) 
        { 
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            // dd($file, $extension);
            $filename =time().'.'.$extension;
            // $file->move('../../public/storage/avatars', $filename);
            // $file->store();
            // $path = $file->store('avatars', ['disk' => 'public']);
            // $file->storeAs('../../public/storage/avatars', $filename);
            // dd($path );
            // dd($filename, $file);
            Storage::disk('public')->put('avatars/'.$filename, File::get($file));
            // $url = Storage::url($filename);
            // dd($url);
        }

        // $validatedData['avatar'] = 'uploads/avatars/'. $filename;
        // $path = Storage::putFile('avatars', $request->file('avatar'));

        $validatedData['avatar'] = '/avatars/'.$filename;
        // $validatedData['avatar'] = $url;

        Doctor::create($validatedData);

        return redirect()->route('pharmacies.doctors.show');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctorsData()
    {
        return Datatables::of(Doctor::query())->make(true);
    }
}
