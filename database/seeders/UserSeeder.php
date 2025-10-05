<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@afarrhb.gov.et',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+251911234567',
            'department' => 'IT',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Warehouse Manager',
            'email' => 'warehouse@afarrhb.gov.et',
            'password' => Hash::make('password'),
            'role' => 'warehouse_manager',
            'phone' => '+251922345678',
            'department' => 'Warehouse',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Auditor',
            'email' => 'auditor@afarrhb.gov.et',
            'password' => Hash::make('password'),
            'role' => 'auditor',
            'phone' => '+251933456789',
            'department' => 'Finance',
            'is_active' => true,
        ]);
    }
}
