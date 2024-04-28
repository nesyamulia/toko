<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthenticateCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;

class CustomerLoginController extends Controller
{
    // Menampilkan formulir login
    public function showLoginForm()
    {
        return view('admin.customer.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // Tentukan kredensial berdasarkan input
        $credentials = $request->only('password');
        if (filter_var($request->login, FILTER_VALIDATE_EMAIL)) {
            // Jika email, gunakan email sebagai kunci
            $credentials['email'] = $request->login;
        } else {
            // Jika bukan email, gunakan name sebagai kunci
            $credentials['name'] = $request->login;
        }
    
        // Ambil password dari input
        $password = $request->input('password');
    
        // Cari pengguna berdasarkan kredensial
        $user = Customer::where('email', $credentials['email'] ?? null)
                        ->orWhere('name', $credentials['name'] ?? null)
                        ->first();
    
        // Jika pengguna ditemukan dan password cocok
        if ($user && Hash::check($password, $user->password)) {
            // Autentikasi pengguna
            Auth::guard('customers')->login($user);
    
            // Redirect ke halaman yang diinginkan
            return redirect('/category');

        }

        // Jika autentikasi gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors(['login' => 'Nama lengkap atau email, atau password salah.'])->withInput($request->only('login'));
    }
}

