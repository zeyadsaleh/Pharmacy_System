<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

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
