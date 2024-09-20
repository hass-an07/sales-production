<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('roles-permissions.index', compact('permissions'));
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
    public function store(Request $request)
    {
        $vaidator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions,name'
        ]);

        if($vaidator->fails()){
            return redirect()->back()->withErrors($vaidator)->withInput();
        }

        $permission = Permission::create([
            'name' => $request->name
        ]);

        if($permission){
            return redirect()->back()->with('success', 'Permission created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::find($id);
        return view('roles-permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $permission = Permission::findOrFail($id); // Find the existing permission by ID
        
        $permission->update([
            'name' => $request->name
        ]);
        
        if ($permission) {
            return redirect()->route('permission.index')->with('success', 'Permission updated successfully');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete();
         return redirect()->back()->with('error', 'Permission deleted successfully');
    }
}
