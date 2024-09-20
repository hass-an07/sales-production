<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
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

        $permission = Role::create([
            'name' => $request->name
        ]);

        if($permission){
            return redirect()->back()->with('success', 'Role created successfully');
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
        $role = Role::find($id);
        return view('roles.edit', compact('role'));
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
        
        $role = Role::findOrFail($id); // Find the existing role by ID
        
        $role->update([
            'name' => $request->name
        ]);
        
        if ($role) {
            return redirect()->route('role.index')->with('success', 'Role updated successfully');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Role::find($id);
        $permission->delete();
         return redirect()->back()->with('error', 'Role deleted successfully');
    }

    public function addOrUpdatePermission($id){
        $role = Role::find($id);
        $permissions = Permission::all();
        $rolePermission = DB::table('role_has_permissions')
    ->where('role_has_permissions.role_id', $role->id)
    ->pluck('role_has_permissions.permission_id')
    ->all();

        ;

        return view('roles.addPermission', compact('permissions','role','rolePermission'));
    }
    public function givePermissionToRole(Request $request,$id){
        
        $validator = Validator::make($request->all(), [
            'permission' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $role = Role::find($id);
        $role->syncPermissions($request->permission);
        
        return redirect()->back()->with('success' ,'Permission added successfully');
    }
}
