<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Doctor;

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

    public function storeDoctors() {

        $request = request();

        Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'national_id' => $request->national_id,
            'avatar' => $request->avatar,
            'pharmacy_id' => 1
        ]);

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
