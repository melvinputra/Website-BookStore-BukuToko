<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form for user
    public function showLogin()
    {
        return view('auth.login');
    }

    // Show login form for admin
    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle user/admin login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on role
            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/admin/dashboard')->with('success', 'Selamat datang, Admin!');
            }

            return redirect()->intended('/user/dashboard')->with('success', 'Selamat datang!');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    // Handle registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect('/user/dashboard')->with('success', 'Registrasi berhasil!');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout!');
    }
}
