<?php

namespace App\Http\Controllers;

use App\Models\MaterialType;
use App\Http\Requests\StoreMaterialTypeRequest;
use App\Http\Requests\UpdateMaterialTypeRequest;
use Illuminate\Support\Facades\Validator;

class MaterialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materialType = MaterialType::all();
        return view('MaterialType.list',compact('materialType'));
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
    public function store(StoreMaterialTypeRequest $request)
    {
        $validator = Validator::make($request->all(),[
            'material_type' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $materialType = new MaterialType();
        $materialType->material_type = $request->material_type;
        $materialType->save();

        return redirect()->back()->with('success','Material type added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaterialType $materialType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaterialType $materialType)
    {
        return view('MaterialType.edit',compact('materialType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialTypeRequest $request, MaterialType $materialType)
    {
        $materialType->material_type = $request->material_type;
        $materialType->update();
        return redirect()->route('materialType.index')->with('success','Material type Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaterialType $materialType)
    {
        $materialType->delete();
        return redirect()->back()->with('success','Material type deleted successfully');

    }
}
