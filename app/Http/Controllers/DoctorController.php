<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Doctor;
use Yajra\Datatables\Datatables;


class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:doctor']);
    }

    public function index()
    {
        $user = Auth::User();
        // dd($user);
        if ($user->hasRole('doctor')) {
            $doctor = Doctor::find($user->profile->id);
            return view('index',['doctor' => $doctor, 'user' => $user]);
        }   
        else{
            return view('layouts.404');
        }
    }

}
