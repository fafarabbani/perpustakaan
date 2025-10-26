<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'uuid' => Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        $kasir = User::create([
            'uuid' => Str::uuid(),
            'name' => 'Kasir User',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'kasir',
        ]);

        $user = User::create([
            'uuid' => Str::uuid(),
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);
    }
}
