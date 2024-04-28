<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Tambahkan ini untuk model User

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('password');

        // Cek apakah yang dimasukkan adalah email atau bukan
        if (filter_var($request->login, FILTER_VALIDATE_EMAIL)) {
            // Jika email, gunakan email sebagai kunci
            $credentials['email'] = $request->login;
        } else {
            // Jika bukan email, gunakan name sebagai kunci
            $credentials['name'] = $request->login;
        }

        // Attempt untuk melakukan proses login
        if (Auth::attempt($credentials)) {
            // Periksa roles pengguna dan arahkan ke halaman yang sesuai
            if (Auth::user()->roles === 'admin' || Auth::user()->roles === 'owner') {
                if ($request->session()->has('url.intended')) {
                    return redirect()->intended('/dashboard');
                }
                return redirect('/dashboard');
            } else {
                // Jika login berhasil dan pengguna adalah pelanggan, arahkan ke /category
                return redirect('/category');
            }
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return redirect()->back()->withInput($request->only('login'))->withErrors([
            'login' => 'These credentials do not match our records.',
        ]);
    }
}