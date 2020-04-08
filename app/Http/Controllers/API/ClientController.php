<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $client = Client::find($user->profile->id);

        $client['token'] = $user->createToken($request->password)->plainTextToken;
    
        return new ClientResource($client);
    }

    public function register(ClientRequest $request) {
        $validatedData = $request->validated();

        if($request->hasfile('avatar'))
        {
            $file = $request->file('avatar');
            $originalName = $file->getClientOriginalName();
            // dd($file->getClientOriginalName());
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;

            Storage::disk('public')->put('avatars/'.$filename, File::get($file));
        }

        // First slash is for concatenation with url of blade in ajax
        $validatedData['avatar'] = '/'.$filename;

        // dd($file->getClientOriginalName());


        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        $client = Client::create([
            'name' => $validatedData['name'],
            'gender' => $validatedData['gender'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'national_id' => $validatedData['national_id'],
            'avatar' => $validatedData['avatar'],
            'avatar_file_name' => $originalName ? $originalName : 'anything',
            'mobile_number' => $validatedData['mobile_number'],
            'is_insured' => false
        ]);

        $client->user()->save($user);

        return new ClientResource($client);
    }
}
