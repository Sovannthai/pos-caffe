<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExspendStoreRequest;
use App\Models\Exspend;
use App\Models\User;
use Illuminate\Http\Request;

class ExspendController extends Controller
{
    public function index(){
        $exspends = Exspend::all();
        $total = $exspends->sum('amount');
        return view('exspend.index',compact('exspends','total'));
    }

    public function create(){
        $exspends = Exspend::all();
        return view('exspend.create',compact('exspends'));
    }

    public function store(Request $request){
        $exspend = Exspend::Create([
            'user_id'=>auth()->user()->id,
            'name'=>$request->name,
            'amount'=>$request->amount,
            'description'=>$request->description,
            'exspend_note'=>$request->exspend_note,
        ]);
        return redirect()->route('exspend.index',compact('exspend'));
    }

    public function destroy($id)
    {
        $unit = Exspend::find($id);
        $unit->delete();
        return redirect()->back();
    }

    public function edit($id){
        $exspend = Exspend::find($id);
        return view('exspend.edit',compact('exspend'));
    }

    public function update(ExspendStoreRequest $request, Exspend $exspend){
        $exspend->name = $request->name;
        $exspend->amount = $request->amount;
        $exspend->description = $request->description;
        $exspend->exspend_note = $request->exspend_note;

        if (!$exspend->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating product.');
        }
        return redirect()->route('exspend.index')->with('success', 'Success, Product has been updated.');
    }
}
