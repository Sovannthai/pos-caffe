<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UnitStoreRequest;
use App\Models\Unit;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $unit = Unit::all();
        return view('unit.index',compact('unit'));
    }

    public function create()
    {
        return view('unit.create');
    }

    public function store(UnitStoreRequest $request, Unit $unit)
    {
        $unit = Unit::create([
            'unit_name' => $request->unit_name,
            'shot_name' => $request->shot_name,
        ]);
        return redirect(route('unit.index',compact('unit')));
    }

    public function edit($id){
        $unit = Unit::find($id);
        return view('unit.edit',compact('unit'));
    }

    public function update(UnitStoreRequest $request, Unit $unit){
        $unit->unit_name = $request->unit_name;
        $unit->shot_name = $request->shot_name;

        if (!$unit->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating product.');
        }
        return redirect()->route('unit.index')->with('success', 'Success, Product has been updated.');
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->back();
    }
}
