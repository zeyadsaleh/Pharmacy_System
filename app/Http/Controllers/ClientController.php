<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientResource;
use App\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;


class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->ajax()) {
                return Datatables::of(ClientResource::collection(Client::all()))
                ->make(true);
            }
            return view('userAddresses.index');
        }
        return view('clients.index');
    }
    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());
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
        return redirect()->route('admin.clients.index');
    }

    public function edit(Request $request)
    {
        $client = Client::find($request->client);
        $email = User::select('email')->where('profile_id',$client->id)->first()->email;
        return view('clients.edit', [
            'client' => $client,
            'email' => $email
        ]);
    }
    public function update(Request $request)
    {
        if (auth()->user()->id ==  $request->client && auth()->user()->hasRole('client')) {
            if ($request->has('email')) {

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
            // Client::where('id', $request->client)->update([
            //     'name' => $request->name,
            //     'email' => $request->email,
            // ]);
             return redirect()->route('admin.cleints.index');
        }
    }

    public function destroy()
    {
        Client::where('id', request()->client)->delete();
        return redirect()->route('admin.clients.index');
    }
}
