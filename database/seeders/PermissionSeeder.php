<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            /*
            |--------------------------------------------------------------------------
            | Dashboard
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'read-dashboard',
                'guard_name' => 'web',
                'group' => 'Manajemen Dashboard',
                'display_name' => 'Lihat Data',
            ],


            /*
            |--------------------------------------------------------------------------
            | Pengguna
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'create-users',
                'guard_name' => 'web',
                'group' => 'Manajemen Pengguna',
                'display_name' => 'Tambah Data',
            ],
            [
                'name' => 'read-users',
                'guard_name' => 'web',
                'group' => 'Manajemen Pengguna',
                'display_name' => 'Lihat Data',
            ],
            [
                'name' => 'edit-users',
                'guard_name' => 'web',
                'group' => 'Manajemen Pengguna',
                'display_name' => 'Edit Data',
            ],
            [
                'name' => 'delete-users',
                'guard_name' => 'web',
                'group' => 'Manajemen Pengguna',
                'display_name' => 'Hapus Data',
            ],


            /*
            |--------------------------------------------------------------------------
            | Jabatan / Role
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'create-roles',
                'guard_name' => 'web',
                'group' => 'Manajemen Jabatan',
                'display_name' => 'Tambah Data',
            ],
            [
                'name' => 'read-roles',
                'guard_name' => 'web',
                'group' => 'Manajemen Jabatan',
                'display_name' => 'Lihat Data',
            ],
            [
                'name' => 'edit-roles',
                'guard_name' => 'web',
                'group' => 'Manajemen Jabatan',
                'display_name' => 'Edit Data',
            ],
            [
                'name' => 'delete-roles',
                'guard_name' => 'web',
                'group' => 'Manajemen Jabatan',
                'display_name' => 'Hapus Data',
            ],


            /*
            |--------------------------------------------------------------------------
            | Project
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'create-projects',
                'guard_name' => 'web',
                'group' => 'Manajemen Project',
                'display_name' => 'Tambah Data',
            ],
            [
                'name' => 'read-projects',
                'guard_name' => 'web',
                'group' => 'Manajemen Project',
                'display_name' => 'Lihat Data',
            ],
            [
                'name' => 'edit-projects',
                'guard_name' => 'web',
                'group' => 'Manajemen Project',
                'display_name' => 'Edit Data',
            ],
            [
                'name' => 'delete-projects',
                'guard_name' => 'web',
                'group' => 'Manajemen Project',
                'display_name' => 'Hapus Data',
            ],


            /*
            |--------------------------------------------------------------------------
            | Contract
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'create-contracts',
                'guard_name' => 'web',
                'group' => 'Manajemen Contract',
                'display_name' => 'Tambah Data',
            ],
            [
                'name' => 'read-contracts',
                'guard_name' => 'web',
                'group' => 'Manajemen Contract',
                'display_name' => 'Lihat Data',
            ],
            [
                'name' => 'edit-contracts',
                'guard_name' => 'web',
                'group' => 'Manajemen Contract',
                'display_name' => 'Edit Data',
            ],
            [
                'name' => 'delete-contracts',
                'guard_name' => 'web',
                'group' => 'Manajemen Contract',
                'display_name' => 'Hapus Data',
            ],
            [
                'name' => 'send-contracts',
                'guard_name' => 'web',
                'group' => 'Manajemen Contract',
                'display_name' => 'Kirim Contract',
            ],


            /*
            |--------------------------------------------------------------------------
            | Employee Contract
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'read-my-contracts',
                'guard_name' => 'web',
                'group' => 'Contract Saya',
                'display_name' => 'Lihat Contract',
            ],

        ];

        foreach ($permissions as $value) {

            $permission = Permission::updateOrCreate(
                [
                    'name' => $value['name'],
                    'guard_name' => $value['guard_name'],
                ],
                [
                    'group' => $value['group'],
                    'display_name' => $value['display_name'],
                ]
            );

            $role = Role::where('id', 1)->first();

            if ($role) {
                $role->givePermissionTo($permission);
            }
        }

        $this->command->info(
            'Seeding Permissions has been completed!'
        );
    }
}