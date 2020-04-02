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
