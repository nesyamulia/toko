<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerRegisterController extends Controller
{
    // Metode untuk menampilkan formulir pendaftaran pelanggan
    public function showRegistrationForm()
    {
        return view('admin.customer.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat entri baru untuk pelanggan
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        

        // Redirect ke halaman login setelah registrasi berhasil
        return redirect()->route('customer.login')->with('success', 'Registration successful! Please login.');
    }
}
