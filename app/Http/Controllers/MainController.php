<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        if(auth()->user()->hasRole('super-admin')) {
            return redirect()->route('admin.index');
        } else if(auth()->user()->hasRole('pharmacy')) {
            return redirect()->route('pharmacies.index');
        } else if(auth()->user()->hasRole('doctor')) {
            return redirect()->route('doctors.index');
        } 
    }
}
