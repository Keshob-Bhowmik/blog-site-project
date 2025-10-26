<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register()
    {

        return view('auth.register');
    }

    public function registerStore(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:300|email|unique:users',
            'password' => 'required|min: 8|confirmed'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $existUser = User::latest()->get();
        if ($existUser->isEmpty()) {
            $user->role = 'admin';
        } else {
            $user->role = 'user';
        }
        $user->save();
        Auth::login($user);
        return redirect('/')->with('success', 'Registration successful!');
    }
    public function login(){
        return view('auth.login');
    }
    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|max:300|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            flash()->success('Login successfully!');
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        flash()->success('Logout successfully!');
        return redirect('/');
    }
}
