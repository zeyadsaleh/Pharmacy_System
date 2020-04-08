<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreClientRequest;
use Illuminate\Http\Request;
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
            $clients = Client::all();
            return DataTables::of($clients)
                ->addColumn('action', function ($clients) {
                    $button = '<a type="button" name="edit" href="clients/' . $clients->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                    $button .= "&nbsp;&nbsp;&nbsp";
                    $button .= "<form method='POST' id='delete-$clients->id' class='d-inline' action=" . route('admin.clients.destroy', ['client' => $clients->id]) . "><input type='hidden' name='_token' value='" . csrf_token() . "'><input type='hidden' name='_method' value='DELETE'>";
                    $button .= "<button type='button' onclick='deleteArea($clients->id)' data-id='$clients->id' class='btn mx-1 btn-danger btn-sm'>Delete</button></form>";
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
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
        return redirect()->route('admin.clients.index');
    }

    public function edit(Request $request)
    {
        $client = Client::find($request->client);
        return view('clients.edit', [
            'client' => $client
        ]);
    }
    public function update(Request $request)
    {
        Client::where('id', $request->cleint)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('admin.cleints.index');
    }

    public function destroy()
    {
        Client::where('id', request()->client)->delete();
        return redirect()->route('admin.clients.index');
    }
}
