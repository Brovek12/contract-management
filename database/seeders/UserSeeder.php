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
            // ============================
            // Admin
            // ============================
            [
                'name'            => 'Super Admin',
                'email'           => 'admin@example.com',
                'phone'           => '08123456789',
                'username'        => 'admin',
                'password'        => Hash::make('123123'),
                'employee_number' => 'SUPER-001',
                'role'            => 'Admin',
            ],

            // ============================
            // HRD & Management
            // ============================
            [
                'name'            => 'Orang HRD',
                'email'           => 'hrd@example.com',
                'phone'           => '08123456789',
                'username'        => 'hrdbukaka',
                'employee_number' => 'HRD-BPN-ADM-002',
                'password'        => Hash::make('123123'),
                'role'            => 'HRD',
                'projects_id'     => '2',
            ],
            [
                'name'            => 'Kepala HRD',
                'email'           => 'kepalahrd@example.com',
                'phone'           => '08123456789',
                'username'        => 'kepalahrd',
                'employee_number' => 'HRD-BPN-HEAD-001',
                'password'        => Hash::make('123123'),
                'role'            => 'HRD_Head',
                'projects_id'     => '2',
            ],
            [
                'name'            => 'Muslimin Sanafi',
                'email'           => 'muslimin@example.com',
                'phone'           => '08123456789',
                'username'        => 'musliminsanafi',
                'employee_number' => 'MAN-BPN-HEAD-001',
                'password'        => Hash::make('123123'),
                'role'            => 'General_Manager',
                'projects_id'     => '2',
            ],

            // ============================
            // Employee (existing)
            // ============================

            [
                'name'            => 'Budi Santoso',
                'email'           => 'budi@example.com',
                'phone'           => '08123456701',
                'username'        => 'budisantoso',
                'password'        => Hash::make('123123'),
                'role'            => 'Employee',
                'employee_number' => 'EMP-PHSS-RIG-003',
                'projects_id'     => '1',
            ],
          
            [
                'name'            => 'Joko Widodo',
                'email'           => 'joko@example.com',
                'phone'           => '08123456705',
                'username'        => 'jokowidodo',
                'password'        => Hash::make('123123'),
                'role'            => 'Employee',
                'employee_number' => 'EMP-PHKT-OFF-007',
                'projects_id'     => '3',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name'            => $userData['name'],
                'email'           => $userData['email'],
                'phone'           => $userData['phone'],
                'username'        => $userData['username'],
                'password'        => $userData['password'],
                'projects_id'     => $userData['projects_id'] ?? null,
                'employee_number' => $userData['employee_number'] ?? null,
            ]);

            $user->assignRole($userData['role']);
        }
    }
}