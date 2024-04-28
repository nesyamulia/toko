<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        // Cek apakah user sedang mengakses route yang terdaftar di dalam grup middleware 'redirect.previous'
        $isActive = Route::currentRouteName() == 'home-page.index' || 
                    Route::currentRouteName() == 'blog.index' || 
                    Route::currentRouteName() == 'cart.index' || 
                    Route::currentRouteName() == 'category.index' || 
                    Route::currentRouteName() == 'checkout.index' || 
                    Route::currentRouteName() == 'contact.index' || 
                    Route::currentRouteName() == 'elements.index' || 
                    Route::currentRouteName() == 'single-blog.index' || 
                    Route::currentRouteName() == 'single-product.index' || 
                    Route::currentRouteName() == 'tracking.index';

        // Set status berdasarkan hasil pengecekan di atas
        $status = $isActive ? 1 : 0;

        return view('admin.user.create', compact('status'));
    }


    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'roles' => 'required|string|in:admin,owner',
            'aktif' => 'required|boolean', 
        ]);

        // Buat instance user baru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Gunakan Hash::make() untuk meng-hash password
        $user->roles = $request->roles;
        $user->aktif = $request->aktif; // Set nilai kolom aktif
        $user->email_verified_at = now(); // Set email_verified_at menjadi waktu sekarang
        $user->remember_token = Str::random(10); // Buat remember token acak
        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8', // Password bisa kosong atau minimal 8 karakter
            'roles' => 'required|string|in:admin,owner',
            'aktif' => 'required|boolean', // Validasi untuk kolom aktif
        ]);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->aktif = $request->aktif; // Set nilai kolom aktif
        
        // Update password jika ada input password baru
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}
