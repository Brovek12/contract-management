<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'phone' => '08123456789',
                'username' => 'admin',
                'password' => Hash::make('123123'),
                 'employee_number' => 'HRD-ADM-001',
                'role' => 'Admin'
            ],
            [
                'name' => 'Cak Monde',
                'email' => 'sitea@example.com',
                'phone' => '08123456789',
                'username' => 'site123',
                'password' => Hash::make('123123'),
                'role' => 'Employee',
                   'employee_number' => 'EMP-PHSS-002',
                'projects_id' => '1'
            ],
            [
                'name' => 'Om HRD',
                'email' => 'ho@example.com',
                'phone' => '08123456789',
                'username' => 'ho1234',
                'employee_number' => 'HRD-ADM-002',
                'password' => Hash::make('123123'),
                'role' => 'HRD',
                'projects_id' => '2'
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'username' => $userData['username'],
                'password' => $userData['password'],
                'projects_id' => $userData['projects_id'] ?? null,
                'employee_number' => $userData['employee_number'] ?? null,
            ]);

            $user->assignRole($userData['role']);
        }
    }
}
