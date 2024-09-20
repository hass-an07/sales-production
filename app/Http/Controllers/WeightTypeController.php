<?php

namespace App\Http\Controllers;

use App\Models\WeightType;
use App\Http\Requests\StoreWeightTypeRequest;
use App\Http\Requests\UpdateWeightTypeRequest;
use Illuminate\Support\Facades\Validator;

class WeightTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weightType = WeightType::all();
        return view('WeightType.list',compact('weightType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWeightTypeRequest $request)
    {
        $validator = Validator::make($request->all(),[
            'weight_type' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $WeightType = new WeightType();
        $WeightType->created_by = $request->weight_type;
        $WeightType->weight_type = $request->weight_type;
        $WeightType->save();

        return redirect()->back()->with('success', 'Weight Type Created Sucessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(WeightType $weightType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WeightType $weightType)
    {
        return view('WeightType.edit', compact('weightType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWeightTypeRequest $request, WeightType $weightType)
    {
        $weightType->weight_type = $request->weight_type;
        $weightType->update();

        return redirect()->route('weightType.index')->with('success', 'WeightT ype updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeightType $weightType)
    {
        $weightType->delete();
        return redirect()->route('weightType.index')->with('success', 'Weight Type deleted successfully');
    }
}
