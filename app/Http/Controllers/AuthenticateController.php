<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    public function login()
    {

        return view('authenticate.login');
    }

    public function register()
    {
        $roles = Role::all();
        return view('authenticate.register', compact('roles'));
    }
    // public function role()
    // {
    //     $modules = Module::all();
    //     return view('authenticate.role',compact('modules'));
    // }

    //     public function storeRole(Request $request)
    // {
    //     // dd($request);
    //     // Validate the incoming request
    //     $request->validate([
    //         'role' => 'required|string|max:255',
    //         'modules' => 'required|array',
    //     ]);

    //     // Store the role (assuming there's a Role model)
    //     $role = new Role();
    //     $role->role = $request->input('role');
    //     $role->modules = serialize($request->input('modules'));
    //     $role->save();

    //     // Attach the selected modules to the role


    //     // Redirect or return a response
    //     return redirect()->back()->with('success', 'Role created successfully with selected modules!');
    // }



    public function user()
    {
        $users = User::all();
        return view('authenticate.user', compact('users'));
    }


    public function processregister(Request $request)
    {
        // dd($request);
        $validate = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);

        // Create the user and return the model instance
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the role to the user using syncRoles
        $user->syncRoles($request->role);

        session()->flash('success', 'You have been registered successfully');
        return redirect()->route('account.user');
    }

    public function authenticate(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validatedData) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended'));
                }

                return redirect()->route('dashboard.index');
            } else {
                session()->flash('error', 'Either email/password is incorrect');
                return redirect()->route('account.login');
            }
        } else {

            return redirect()->route('account.login');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('account.user');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $userRole = $user->roles->pluck('name')->all();

        $roles = Role::all();
        return view('authenticate.edit', compact('user', 'roles','userRole'));
    }

    public function update(Request $request, $id)
{
    // Validate the request
    $validate = $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email,' . $id, // Ignore the current user's email in validation
        'password' => 'nullable|min:5|confirmed' // Password is optional during updates
    ]);

    // Find the user by ID
    $user = User::findOrFail($id);

    // Prepare the data for updating, excluding the password if it's empty
    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Only update the password if it was provided
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    // Update the user data
    $user->update($data);

    // Sync roles
    $user->syncRoles($request->role);

    // Flash success message
    session()->flash('success', 'User updated successfully');

    // Redirect to the desired route
    return redirect()->route('account.user');
}

}
