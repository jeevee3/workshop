<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle user registration
    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
            'password' => 'required|confirmed|min:4|max:8',
        ]);

        try {
            $new_user = User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($new_user);

            return redirect('/dashboard')->with('success', 'Registration Successful!');
        } catch (\Exception $e) {
            return back()->with('fail', $e->getMessage());
        }
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle user login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4|max:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard')->with('success', 'Login Successful!');
        }

        return back()->with('fail', 'Invalid Email or Password.');
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login')->with('success', 'Logged Out Successfully.');
    }

    // Dashboard - Only accessible when logged in
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('fail', 'Please login first.');
        }

        return view('auth.dashboard');
    }
}
