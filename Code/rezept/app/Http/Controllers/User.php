<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;

class User extends Controller
{
    public function login(){
        return view('login', []);
    }

    public function register(){
        return view('register', []);
    }

    public function verify(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return redirect()->back()->withInput()->withErrors([
            'email' => 'Nutzerdaten unstimmig '
        ]);
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = UserModel::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Log in the user after successful registration
        Auth::login($user);

        // Redirect the user to the desired location
        return redirect('/');
    }

    public function unverify(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
