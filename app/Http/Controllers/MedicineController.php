<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicineRequest;
use App\Medicine;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicineController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin']);
    }

    public function index(Request $request)
    {
           if ($request->ajax()) {
            $medicine = Medicine::all();
            return DataTables::of($medicine)
            ->addColumn('action', function ($medicine) {
                $button = '<a type="button" name="edit" href="medicines/' . $medicine->id . '/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                $button .= "&nbsp;&nbsp;&nbsp";
                // $button .= "<form method='POST' id='delete-$medicine->id' class='d-inline' action=".route('medicines.destroy', ['medicine' => $medicine->id])."><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='_method' value='DELETE'>";
                $button .= "<button type='button' onclick='deleteMedicine($medicine->id)' data-id='$medicine->id' class='btn mx-1 btn-danger btn-sm'>Delete</button></form>";
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('medicines.index');
    }
    public function create()
    {
        return view('medicines.create');
    }

    public function store(StoreMedicineRequest $request)
    {
        Medicine::create($request->validated());
        return redirect()->route('medicines.index');
    }

    public function edit(Request $request) {
        $medicine = Medicine::find($request->medicine);
        return view('medicines.edit', [
            'medicine' => $medicine
        ]);
    }
    public function update(Request $request) {
        Medicine::where('id', $request->medicine)->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect()->route('medicines.index');
    }

    public function destroy() {
        Medicine::where('id', request()->medicine)->delete();
        return redirect()->route('medicines.index');
    }
}
