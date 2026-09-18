<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Employee']);
        Role::create(['name' => 'HRD']);
        Role::create(['name' => 'General_Manager']);
        Role::create(['name' => 'HRD_Head']);
    }
}
