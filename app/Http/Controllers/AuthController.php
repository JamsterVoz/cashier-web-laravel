<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // public function login()
    // {
    //     if (Auth::check()){
    //         return redirect()->route('productview');
    //     }else{
    //         return view('auth.login');
    //     }
    // }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]); 

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('productview');
            } else {
                return back();
            }
    }

    // public function register()
    // {
    //     return view('auth.register');
    // }

    // public function registerProcess(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|unique',
    //         'password' => 'required|max:255',
    //     ]);

    //     User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return redirect()->route('login')->with('success', "Success");
    // }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();  
        return redirect('login');
    }
}
