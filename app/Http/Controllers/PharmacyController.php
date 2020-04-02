<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Pharmacy;

class PharmacyController extends Controller
{
    public function index() {
        return view('Pharmacy.index');
    }

    public function show() {
        return view('Pharmacy.show');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(Pharmacy::query())->make(true);
    }
}
