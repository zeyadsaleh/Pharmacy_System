<?php

namespace App\Http\Controllers;

use App\Area;
use App\Doctor;
use App\Http\Requests\DoctorRequest;
use App\Pharmacy;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin']);
    }

    public function index()
    {
        return view('admin.index');
    }
}

