<?php

namespace Database\Seeders;

use App\Models\HRD\Contract;
use App\Models\Project\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // =====================================================
        // Ambil user & project yang dibutuhkan
        // =====================================================
        $admin    = User::where('username', 'admin')->first();
        $hrdHead  = User::where('username', 'hanaduharlan')->first();
        $gm       = User::where('username', 'musliminsanafi')->first();

        $project1 = Project::find(1);
        $project2 = Project::find(2);
        $project3 = Project::find(3);

        // =====================================================
        // Kumpulan employee (user) untuk kontrak
        // =====================================================
        $employees = User::role('Employee')->get();

        if ($employees->isEmpty()) {
            $this->command->warn('Tidak ada user dengan role Employee. Jalankan UserSeeder dulu.');
            return;
        }

        // =====================================================
        // Daftar kontrak yang akan dibuat
        // Format: nomor, tipe, judul, project, status,
        //         start_date, end_date, basic_salary
        // =====================================================
        $contracts = [
            [
                'contract_number' => 'CT-PHM-2025-001',
                'type'            => 'phm',
                'title'           => 'Perjanjian Kerja Waktu Tertentu — Operator Rig',
                'project_id'      => $project1?->id,
                'status'          => 'draft',
                'start_date'      => '2025-09-01',
                'end_date'        => '2026-08-31',
                'basic_salary'    => 5500000,
            ],
            [
                'contract_number' => 'CT-PHM-2025-002',
                'type'            => 'phm',
                'title'           => 'Perjanjian Kerja Waktu Tertentu — Teknisi Mesin',
                'project_id'      => $project1?->id,
                'status'          => 'sent',
                'start_date'      => '2025-09-14',
                'end_date'        => '2026-09-13',
                'basic_salary'    => 6000000,
            ],
            [
                'contract_number' => 'CT-PHM-2025-003',
                'type'            => 'phm',
                'title'           => 'Perjanjian Kerja Waktu Tertentu — Helper',
                'project_id'      => $project1?->id,
                'status'          => 'viewed',
                'start_date'      => '2025-09-15',
                'end_date'        => '2026-09-14',
                'basic_salary'    => 4500000,
            ],
            [
                'contract_number' => 'CT-PHSS-2025-001',
                'type'            => 'phss',
                'title'           => 'Perjanjian Kerja Harian — Staff Administrasi',
                'project_id'      => $project2?->id,
                'status'          => 'signed',
                'start_date'      => '2025-09-20',
                'end_date'        => '2026-03-19',
                'basic_salary'    => 4000000,
            ],
            [
                'contract_number' => 'CT-PHSS-2025-002',
                'type'            => 'phss',
                'title'           => 'Perjanjian Kerja Harian — Security',
                'project_id'      => $project2?->id,
                'status'          => 'signed-hrd',
                'start_date'      => '2025-10-01',
                'end_date'        => '2026-04-30',
                'basic_salary'    => 3800000,
            ],
            [
                'contract_number' => 'CT-PHSS-2025-003',
                'type'            => 'phss',
                'title'           => 'Perjanjian Kerja Harian — Cleaning Service',
                'project_id'      => $project2?->id,
                'status'          => 'signed-head',
                'start_date'      => '2025-10-05',
                'end_date'        => '2026-04-04',
                'basic_salary'    => 3500000,
            ],
            [
                'contract_number' => 'CT-PHKT-2025-001',
                'type'            => 'phkt',
                'title'           => 'Perjanjian Kerja Waktu Tidak Tertentu — Supervisor',
                'project_id'      => $project3?->id,
                'status'          => 'signed-head',
                'start_date'      => '2025-08-01',
                'end_date'        => '2027-07-31',
                'basic_salary'    => 9000000,
            ],
            [
                'contract_number' => 'CT-PHKT-2025-002',
                'type'            => 'phkt',
                'title'           => 'Perjanjian Kerja Waktu Tidak Tertentu — Koordinator Lapangan',
                'project_id'      => $project3?->id,
                'status'          => 'expired',
                'start_date'      => '2023-01-01',
                'end_date'        => '2024-12-31',
                'basic_salary'    => 7500000,
            ],
            [
                'contract_number' => 'CT-PHM-2025-004',
                'type'            => 'phm',
                'title'           => 'Perjanjian Kerja Waktu Tertentu — Operator Alat Berat',
                'project_id'      => $project1?->id,
                'status'          => 'draft',
                'start_date'      => '2025-09-14',
                'end_date'        => '2026-09-13',
                'basic_salary'    => 6500000,
            ],
            [
                'contract_number' => 'CT-PHSS-2025-004',
                'type'            => 'phss',
                'title'           => 'Perjanjian Kerja Harian — Driver',
                'project_id'      => $project2?->id,
                'status'          => 'sent',
                'start_date'      => '2025-09-25',
                'end_date'        => '2026-03-24',
                'basic_salary'    => 4200000,
            ],
        ];

        // =====================================================
        // Simpan contract satu per satu
        // =====================================================
        foreach ($contracts as $index => $data) {

            // Rotasi employee agar tiap contract beda user
            $employee = $employees[$index % $employees->count()];

            // Snapshot data employee
            $employeeName = $employee->name;
            $nik          = '3201' . str_pad((string) ($index + 1), 12, '0', STR_PAD_LEFT);
            $ktpNumber    = '3201' . str_pad((string) ($index + 1), 12, '0', STR_PAD_LEFT);

            // Hitung umur
            $birthDate = now()->subYears(28 + $index); // 28–37 tahun
            $ageAtContract = $birthDate->age;

            Contract::create([
                'contract_number' => $data['contract_number'],
                'contract_date'   => $data['start_date'],
                'type'            => $data['type'],
                'title'           => $data['title'],

                // Relation
                'user_id'         => $employee->id,
                'project_id'      => $data['project_id'],
                'head_user_id'    => $gm?->id,

                // Employee snapshot
                'employee_name'   => $employeeName,
                'department'      => 'Operasional',
                'nik'             => $nik,
                'ktp_number'      => $ktpNumber,
                'birth_place'     => 'Balikpapan',
                'birth_date'      => $birthDate->format('Y-m-d'),
                'age_at_contract' => $ageAtContract,
                'gender'          => $index % 2 === 0 ? 'male' : 'female',
                'address'         => 'Jl. Contoh No. ' . ($index + 1) . ', Balikpapan',

                // Period
                'start_date'      => $data['start_date'],
                'end_date'        => $data['end_date'],

                // Position
                'position'        => 'Staff',
                'work_location'   => 'Balikpapan',
                'domicile'        => 'Balikpapan',

                // Salary
                'basic_salary'    => $data['basic_salary'],

                // Status
                'status'          => $data['status'],

                // Signature (nullable, hanya diisi yang sudah signed ke atas)
                'employee_signature'    => in_array($data['status'], ['signed', 'signed-hrd', 'signed-head', 'expired'])
                                            ? 'signature/employee-' . $data['contract_number'] . '.png'
                                            : null,
                'employee_signed_at'    => in_array($data['status'], ['signed', 'signed-hrd', 'signed-head', 'expired'])
                                            ? now()->subDays(10)
                                            : null,

                'hrd_signature'         => in_array($data['status'], ['signed-hrd', 'signed-head'])
                                            ? 'signature/hrd-' . $data['contract_number'] . '.png'
                                            : null,
                'hrd_signed_at'         => in_array($data['status'], ['signed-hrd', 'signed-head'])
                                            ? now()->subDays(5)
                                            : null,

                'head_signature'        => $data['status'] === 'signed-head'
                                            ? 'signature/head-' . $data['contract_number'] . '.png'
                                            : null,
                'head_signed_at'        => $data['status'] === 'signed-head'
                                            ? now()->subDays(2)
                                            : null,

                // Audit
                'created_by'      => $admin?->id ?? $employee->id,
            ]);
        }
    }
}