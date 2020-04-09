<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


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

    public function register(StoreClientRequest $request) {
        $validatedData = $request->validated();

        if($request->hasfile('avatar'))
        {
            $file = $request->file('avatar');
            $originalName = $file->getClientOriginalName(); // original name of file
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;

            Storage::disk('public')->put('avatars/'.$filename, File::get($file));
        }

        $validatedData['avatar'] = '/'.$filename;

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
            'avatar_file_name' => $originalName,
            'mobile_number' => $validatedData['mobile_number'],
            'is_insured' => false
        ]);

        $user->assignRole('client');

        $client->user()->save($user);

        return new ClientResource($client);
    }

    public function update(UpdateClientRequest $request) {

        if(auth()->user()->id ==  $request->client && auth()->user()->hasrole('client')){
            if($request->has('email')) {
                throw ValidationException::withMessages([
                    'email' => ['Can\'t change email address.'],
                ]);
            }

            if($request->hasfile('avatar')) {
                $file = $request->file('avatar');
                $originalName = $file->getClientOriginalName(); // original name of file
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =time().'.'.$extension;
                Storage::disk('public')->put('avatars/'.$filename, File::get($file));

            }

            $client = Client::find($request->client);

            $client->update([
                'name' => $request->name ? $request->name : $client->name,
                'gender' => $request->gender ? $request->gender : $client->gender,
                'date_of_birth' => $request->date_of_birth ? $request->date_of_birth : $client->date_of_birth,
                'national_id' => $request->national_id ? $request->national_id : $client->national_id,
                'avatar' => $request->avatar ? '/'.$filename : $client->avatar,
                'avatar_file_name' => $request->avatar? $originalName : $client->avatar_file_name,
                'mobile_number' => $request->mobile_number ? $request->mobile_number : $client->mobile_number,
            ]);

            $client->user()->update([
                'password' => $request->password ? Hash::make($request->password) : $client->user->password,
            ]);

            return new ClientResource($client);

        } else {
            throw ValidationException::withMessages([
                'id' => ['You can\'t access this profile'],
            ]);
        }
    }
}
