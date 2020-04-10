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
            $address = Address::find($user->profile->id);
            return new UserAddressResource($address);
        } else {
            return ('404 not-found');
        }
    }

    public function show(Address $address)
    {
        $user = auth()->user();
        if ($user->hasRole('client')) {
            return new UserAddressResource($address);
        } else {
            return ('404 not-found');
        }
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $user = auth()->user();
        if ($user->hasRole('client')) {
            $address->update($request->all());
            return new UserAddressResource($address);
        } else {
            return ('404 not-found');
        }
    }
    public function store(CreateAddressRequest $request, Address $address)
    {
        $user = auth()->user();
        if ($user->hasRole('client')) {
        $address->create($request->all());
        return new UserAddressResource($address);
        } else {
            return ('404 not-found');
        }
    }

    public function delete(Address $address)
    {
        $user = auth()->user();
        if ($user->hasRole('client')) {
        $address->delete($address);
        return response()->json([
            'message' => 'address Deleted'
        ], 204);
        return new UserAddressResource($address);
        } else {
            return ('404 not-found');
        }
    }
    
}
