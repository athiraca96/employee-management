<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user =  User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('password')
        ]);

        $user->assignRole('administrator');
    }
}
