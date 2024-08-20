<?php

namespace App\Http\Controllers;

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
        return view('authenticate.register');
    }


    public function processregister(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);

        if ($validate) {
            $register = DB::table('users')
                ->insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);


            if ($register) {
                session()->flash('success', 'You have been registered successfully');
                return redirect()->route('account.login');
            }
        } else {
            echo 'something went wrong';
        }
    }

    public function authenticate(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validatedData) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                
                if(session()->has('url.intended')){
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
}
