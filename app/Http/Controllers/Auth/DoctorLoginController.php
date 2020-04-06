<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Route;
use Auth;

class AdminLoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:doctor', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
      return view('admin.adminlogin');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('pharmacies.index')); //@TOBECHANGED
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect('/pharmacies'); //@TOBECHANGED
    }
}
