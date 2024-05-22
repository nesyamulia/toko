<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \Database\Factories\UserFactory::new()->create([
            'name' => 'Nesya',
            'email' => 'nesya@gmail.com',
            'roles' => 'owner',
            'password' => Hash::make('12345678'), // Menggunakan Hash untuk menyandikan password
        ]);
    }
}