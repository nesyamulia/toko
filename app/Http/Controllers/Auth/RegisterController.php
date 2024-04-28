<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Menampilkan formulir pendaftaran.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Menyimpan pengguna baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Cek apakah nama pengguna sudah ada di basis data
        $existingUserByName = User::where('name', $request->name)->first();
        if ($existingUserByName) {
            return redirect('register')
                ->with('error', 'Nama pengguna sudah digunakan.')
                ->withInput()
                ->with('registerError', 'name');
        }

        // Cek apakah alamat email sudah ada di basis data
        $existingUserByEmail = User::where('email', $request->email)->first();
        if ($existingUserByEmail) {
            return redirect('register')
                ->with('error', 'Email sudah digunakan.')
                ->withInput()
                ->with('registerError', 'email');
        }

        // Jika semua validasi berhasil, buat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirect ke halaman yang sesuai setelah pendaftaran berhasil
        return redirect('login')->with('success', 'Akun berhasil dibuat. Silakan masuk.');
    }
}



