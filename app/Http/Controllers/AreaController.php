<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\StoreAreaRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $area = Area::all();
            return DataTables::of($area)
                ->addColumn('action', function ($area) {
                    $button = '<a type="button" name="edit" href="areas/' . $area->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                    $button .= "&nbsp;&nbsp;&nbsp";

                    $button .= "<button type='button' onclick='deleteArea($area->id)' data-id='$area->id' class='btn mx-1 btn-danger btn-sm'>Delete</button>";
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('areas.index');
    }
    public function create()
    {
        return view('areas.create');
    }

    public function store(StoreAreaRequest $request)
    {
        Area::create($request->validated());
        return redirect()->route('areas.index');
    }

    public function edit(Request $request)
    {
        $area = Area::find($request->area);
        return view('areas.edit', [
            'area' => $area
        ]);
    }
    public function update(Request $request)
    {
        Area::where('id', $request->area)->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('areas.index');
    }

    public function destroy()
    {
        Area::where('id', request()->area)->delete();
        return redirect()->route('admin.areas.index');
    }
}
