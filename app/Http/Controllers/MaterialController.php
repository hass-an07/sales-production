<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\MaterialType;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materialType = MaterialType::all();
        $material = Material::with('materialType')->get();
        return view('Material.list',compact('materialType','material'));
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
    public function store(StoreMaterialRequest $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(),[
            'material_type_id' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $materials = new Material();
        $materials->material_type_id = $request->material_type_id;
        $materials->material = $request->material;
        $materials->unit = $request->unit;
        $materials->save();

        return redirect()->back()->with('success', 'Material Added Sucessfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $materialType = MaterialType::all();
        return view('Material.edit',compact('material','materialType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialRequest $request, Material $material)
    {
        $material->material_type_id = $request->material_type_id;
        $material->material = $request->material;
        $material->unit = $request->unit;
        $material->save();

        return redirect()->route('material.index')->with('success', 'Material Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->back()->with('success','Material  deleted successfully');
    }
}
