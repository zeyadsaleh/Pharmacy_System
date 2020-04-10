<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use App\Http\Resources\API\UserAddressResource;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Requests\Address\CreateAddressRequest;




class AddressController extends Controller
{

    public function index()
    {

        $user = auth()->user();
        if ($user->hasRole('client')) {
            $address = Address::where('user_id', $user->profile->id)->get();

            return UserAddressResource::collection(
                Address::where('user_id', $user->profile->id)->get()
            );
        } else {
            return response()->json(['error'=>'404 Not Found'], 404);
        }
    }

    public function show(Address $address)
    {
        $user = auth()->user();
        if ($user->hasRole('client')) {
            return new UserAddressResource($address);
        } else {
            return response()->json(['error'=>'404 Not Found'], 404);
        }
    }

    public function update(UpdateAddressRequest $request)
    {
        if (auth()->user()) {
            if(auth()->user()->email_verified_at == !NULL){
                if (auth()->user()->hasRole('client')) {

                    $address = Address::find($request->address);
                    $address->update([
                        'street_name' => $request->street_name ? $request->street_name : $address->street_name,
                        'building_name' => $request->building_name ? $request->building_name : $address->building_name,
                        'floor_number' => $request->floor_number ? $request->floor_number : $address->floor_number,
                        'flat_number' => $request->flat_number ? $request->flat_number : $address->flat_number,
                        'is_main' => $request->is_main ? $request->is_main : $address->is_main,
                        'area_id' => $request->area_id ? $request->area_id : $address->area_id,
                    ]);

                    return new UserAddressResource($address);
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

        $user = auth()->user();
        if ($user->hasRole('client')) {
            $address->update($request->all());

            return new UserAddressResource($address);
        } else {
            return response()->json(['error'=>'404 Not Found'], 404);
        }
    }
    public function store(CreateAddressRequest $request, Address $address)
    {
        $user = auth()->user();
        if ($user->hasRole('client')) {
        Address::create($request->all());
        return new UserAddressResource($address);
        } else {
            return response()->json(['error'=>'404 Not Found'], 404);
        }
    }

    public function delete(Address $address)
    {
        $user = auth()->user();
        if ($user->hasRole('client')) {
            $address->delete($address);
            // return response()->json([
            //     'message' => 'address Deleted'
            // ], 204);
            return new UserAddressResource($address);
        } else {
            return response()->json(['error'=>'404 Not Found'], 404);
        }
    }
    
}
