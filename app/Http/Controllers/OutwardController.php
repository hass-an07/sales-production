<?php

namespace App\Http\Controllers;

use App\Models\Outward;
use App\Http\Requests\StoreOutwardRequest;
use App\Http\Requests\UpdateOutwardRequest;
use App\Models\Department;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Worker;
use Carbon\Carbon;

class OutwardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outwards = Outward::with('worker','department','material')->paginate(10);
        return view('Outward.list', compact('outwards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $supplier = Worker::all();
        $materialTypes = MaterialType::all();
        $currentTime = Carbon::now()->format('H:i');
        return view('Outward.create', compact('currentTime', 'departments', 'supplier', 'materialTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOutwardRequest $request)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'outward' => 'required|string|max:255',
            'g_pass_no' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string|max:255',
            'vehicle' => 'nullable|string|max:255',
            'worker_id' => 'nullable|exists:workers,id',
            'through' => 'nullable|string|max:255',
            'dept_id' => 'nullable|exists:departments,id',
            'materialType_id' => 'nullable|exists:material_types,id',
            'material_id' => 'nullable|exists:materials,id',
            'weightType_id' => 'nullable|exists:weight_types,id',
            'qty' => 'required|string|max:255',
            'username' => 'required|string|max:255',
        ]);
    
        // Create a new record in the outward table
        $outward = Outward::create([
            'status' => $request->input('status'),
            'outward' => $request->input('outward'),
            'g_pass_no' => $request->input('g_pass_no'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'vehicle' => $request->input('vehicle'),
            'worker_id' => $request->input('worker_id'),
            'through' => $request->input('through'),
            'dept_id' => $request->input('dept_id'),
            'materialType_id' => $request->input('materialType_id'),
            'material_id' => $request->input('material_id'),
            'weightType_id' => $request->input('weightType_id'),
            'qty' => $request->input('qty'),
            'username' => $request->input('username'),
        ]);
    
        // Redirect or return a success response
        return redirect()->route('outward.index')->with('success', 'Outward record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Outward $outward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outward $outward)
    {
        $departments = Department::all();
        $supplier = Worker::all();
        $materialTypes = MaterialType::all();
        $currentTime = Carbon::now()->format('H:i');
        return view('Outward.edit', compact('outward', 'currentTime', 'departments', 'supplier', 'materialTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOutwardRequest $request, Outward $outward)
    {
        $outward->update([
            'status' => $request->input('status'),
            'outward' => $request->input('outward'),
            'g_pass_no' => $request->input('g_pass_no'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'vehicle' => $request->input('vehicle'),
            'worker_id' => $request->input('worker_id'),
            'through' => $request->input('through'),
            'dept_id' => $request->input('dept_id'),
            'materialType_id' => $request->input('materialType_id'),
            'material_id' => $request->input('material_id'),
            'weightType_id' => $request->input('weightType_id'),
            'qty' => $request->input('qty'),
            'username' => $request->input('username'),
        ]);
        
        // Optionally, redirect or return a response
        return redirect()->route('outward.index')->with('success', 'Outward updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outward $outward)
    {
        $outward->delete();

        return redirect()->route('outward.index')->with('success', 'Outward record deleted successfully.');
    }

    public function getMaterialsAndUnits($materialTypeId)
    {
        // Assuming the Material model has a 'unit' field or a relation that represents the unit
        $materials = Material::where('material_type_id', $materialTypeId)
            ->get(['id', 'material', 'unit']);

        // Prepare an array to store unique units
        $units = [];

        foreach ($materials as $material) {
            if (!in_array($material->unit, $units)) {
                $units[] = $material->unit;
            }
        }

        return response()->json([
            'materials' => $materials,
            'units' => $units,
        ]);
    }
}
