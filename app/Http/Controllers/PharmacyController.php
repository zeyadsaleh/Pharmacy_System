<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Doctor;
use App\Http\Requests\DoctorRequest;
use App\Order;

class PharmacyController extends Controller
{
    public function index()
    {
        return view('Pharmacy.Doctors.index');
    }

    public function showDoctors(Request $request)
    {
        return view('Pharmacy.Doctors.show');
    }

    
    public function createDoctors()
    {
        return view('Pharmacy.Doctors.create');
    }
    
    public function storeDoctors(DoctorRequest $request)
    {
        
        $validatedData = $request->validated();
        $validatedData['pharmacy_id'] = 1;

        if($request->hasfile('avatar'))
        {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;

            Storage::disk('public')->put('avatars/'.$filename, File::get($file));
        } else {
            $filename = 'doctor.jpeg';
        }

        // First slash is for concatenation with url of blade in ajax
        $validatedData['avatar'] = '/avatars/'.$filename;
        
        Doctor::create($validatedData);
        
        return redirect()->route('pharmacies.doctors.show');
    }
    
    public function indexRevenues()
    {
        return view('Pharmacy.Revenues.index');
    }


    public function update(DoctorRequest $request) {

        if($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            Storage::disk('public')->put('avatars/'.$filename, File::get($file));

        } else {
            $filename = 'doctor.jpeg';
        }

        Doctor::where('id', $request->doctor)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'national_id' => $request->national_id,
            'avatar' => '/avatars/'.$filename,
        ]);

        return redirect()->route('pharmacies.doctors.show');
    }

    public function edit(Request $request) {
        $doctor = Doctor::find($request->doctor);

        return view('Pharmacy.Doctors.edit', [
            'doctor' => $doctor
        ]);
    }

    public function delete() {
        Doctor::where('id', request()->doctor)->delete();

        return redirect()->route('pharmacies.doctors.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function ban(Request $request)
    {

        if(!empty($request->doctor)){
            $doctor = Doctor::find($request->doctor);
            $doctor->bans()->create([
                'comment'=>$request->baninfo
            ]);

            $doctor->update([
                'is_ban' => true
            ]);
        }

        return redirect()->route('pharmacies.doctors.show')->with('success','Ban Successfully..');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function unban(Request $request)
    {
        if(!empty($request->doctor)){
            $doctor = Doctor::find($request->doctor);
            $doctor->unban();

            $doctor->update([
                'is_ban' => false
            ]);
        }


        return redirect()->route('pharmacies.doctors.show')
        				->with('success','User Unbanned Successfully.');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctorsData()
    {
        // if ($request->ajax()) {
            // dd(true);
            // $data = Doctor::latest()->get();
            // dd($data);
            return Datatables::of(Doctor::query())
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = "<a href=".route('pharmacies.doctors.edit', ['doctor' => $row->id])." data-toggle='tooltip' data-id='$row->id' data-original-title='Edit' class='edit mx-1 btn btn-primary btn-sm editProduct'>Edit</a>";

                           $btn = $btn."<form method='POST' id='delete-$row->id' class='d-inline' action=".route('pharmacies.doctors.delete', ['doctor' => $row->id])."><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='_method' value='DELETE'>";
   
                           $btn = $btn."<button type='button' onclick='deleteDoctor($row->id)' data-id='$row->id' class='btn mx-1 btn-danger btn-sm'>Delete</button>";

                           $btn = $btn."</form>";

                           $btn = $btn."<form method='POST' class='d-inline' action=''><input type='hidden' name='_method' value='PATCH'>";


                           if($row->is_ban)
                                $btn = $btn."<a class='btn btn-success ban btn-sm' data-id='$row->id' href=".route('pharmacies.doctors.unban', ['doctor' => $row->id])."> Unban</a>";
                            else
                                $btn = $btn."<a class='btn btn-success ban btn-sm' data-id='$row->id' href=".route('pharmacies.doctors.ban', ['doctor' => $row->id])."> Ban</a>";

                            $btn = $btn."</form>";

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        // }
        // return Datatables::of(Doctor::query())->make(true);
    }

}
