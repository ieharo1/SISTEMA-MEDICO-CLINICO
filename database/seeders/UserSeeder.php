<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@medical.com',
            'password' => Hash::make('password')
        ]);
        $admin->assignRole('admin');

        User::create([
            'name' => 'Dr. Juan Pérez',
            'email' => 'juan@medical.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Dra. María García',
            'email' => 'maria@medical.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Dr. Carlos López',
            'email' => 'carlos@medical.com',
            'password' => Hash::make('password')
        ]);
    }
}
