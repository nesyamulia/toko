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
    // Validate input
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);
    
    if ($validator->fails()) {
        return redirect('register')
                    ->withErrors($validator)
                    ->withInput();
    }
    




    // If all validations pass, create a new user
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Redirect to appropriate page after successful registration
    return redirect('login')->with('success', 'Account created successfully. Please log in.');
}

}



