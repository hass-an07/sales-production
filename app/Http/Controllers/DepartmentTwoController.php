<?php

namespace App\Http\Controllers;

use App\Models\DepartmentTwo;
use App\Http\Requests\StoreDepartmentTwoRequest;
use App\Http\Requests\UpdateDepartmentTwoRequest;
use Illuminate\Support\Facades\Validator;

class DepartmentTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department = DepartmentTwo::all();
        return view('Department2.list', compact('department'));
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
    public function store(StoreDepartmentTwoRequest $request)
    {
        $validator = Validator::make($request->all(),[
            'dept_name' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $department = new DepartmentTwo();
        $department->dept_name = $request->dept_name;
        $department->save();

        return redirect()->back()->with('success', 'Department Created Sucessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(DepartmentTwo $departmentTwo)
    {
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DepartmentTwo $departmentTwo)
    {
        // dd($departmentTwo);
        return view('Department2.edit',compact('departmentTwo'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentTwoRequest $request, DepartmentTwo $departmentTwo)
    {
        $departmentTwo->dept_name = $request->dept_name;
        $departmentTwo->update();

        return redirect()->route('department2.index')->with('success', 'Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepartmentTwo $departmentTwo)
    {
        $departmentTwo->delete();
        return redirect()->back()->with('success', 'Department Deleted Sucessfully');
    }
}
