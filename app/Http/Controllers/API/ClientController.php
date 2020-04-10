<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use Validator;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    use VerifiesEmails;

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if($user->email_verified_at == !NULL){

                $request->validate([
                    'email' => 'required|email',
                    'password' => 'required'
                ]);


                if (!$user || !Hash::check($request->password, $user->password)) {
                    throw ValidationException::withMessages([
                        'email' => ['The provided credentials are incorrect.'],
                    ]);
                }

                $client = Client::find($user->profile->id);

                $client['token'] = $user->createToken($request->password)->plainTextToken;

                return new ClientResource($client);
            }
            else {
                return response()->json(['error'=>'Please Verify Email'], 401);
            }
        }else {
            return response()->json(['error'=>'Please Register First'], 401);
        }
    }

    public function register(StoreClientRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $originalName = $file->getClientOriginalName(); // original name of file
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;

            $file->move('avatars/', $filename);
        }

        $validatedData['avatar'] = '/' . $filename;

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

        $user->sendApiEmailVerificationNotification();
        $success['message'] = 'Please confirm yourself by clicking on verify user button sent to you on your email';
        return response()->json(['success' => $success], 200);

        //  return new ClientResource($client);
    }

    public function update(UpdateClientRequest $request)
    {

        if (auth()->user()) {
            if(auth()->user()->email_verified_at == !NULL){
                if (auth()->user()->profile->id ==  $request->client && auth()->user()->hasRole('client')) {
                    if ($request->has('email')) {
                        throw ValidationException::withMessages([
                            'email' => ['Can\'t change email address.'],
                        ]);
                    }

                    if ($request->hasfile('avatar')) {
                        $file = $request->file('avatar');
                        $originalName = $file->getClientOriginalName(); // original name of file
                        $extension = $file->getClientOriginalExtension(); // getting image extension
                        $filename = time() . '.' . $extension;
                        $file->move('avatars/', $filename);
                    }

                    $client = Client::find($request->client);

                    $client->update([
                        'name' => $request->name ? $request->name : $client->name,
                        'gender' => $request->gender ? $request->gender : $client->gender,
                        'date_of_birth' => $request->date_of_birth ? $request->date_of_birth : $client->date_of_birth,
                        'national_id' => $request->national_id ? $request->national_id : $client->national_id,
                        'avatar' => $request->avatar ? '/' . $filename : $client->avatar,
                        'avatar_file_name' => $request->avatar ? $originalName : $client->avatar_file_name,
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
            } else {
                return response()->json(['error'=>'Please Verify Email'], 401);
            }
        } else {
            return response()->json(['error'=>'Please Login or Register'], 401);
        }
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function testEmail()
    {
        return response()->json(['success' => "any data"], 200);
    }
}
