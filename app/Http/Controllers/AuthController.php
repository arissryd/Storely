<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Email atau password tidak sesuai',
            ])->onlyInput('email');
        }

        // Store user in session
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_role', $user->role);

        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle register request
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        // Hash password secara otomatis melalui model
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'merchant',
        ]);

        // Auto-login setelah registrasi
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_role', $user->role);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Session::forget(['user_id', 'user_name', 'user_role']);
        Session::flush();

        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}
