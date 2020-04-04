<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Http\Requests\admin\StoreDoctorRequest;
use App\Pharmacy;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    //
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
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
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
    public function storeDoctor(StoreDoctorRequest $request)
    {
        Doctor::create($request->validated());
        return redirect()->route('admin.doctors.index');
    }
}
