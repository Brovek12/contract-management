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
        $admin = User::where('username', 'admin')->first();
        $hrd   = User::where('username', 'hanaduharlan')->first();
        $gm    = User::where('username', 'musliminsanafi')->first();

        // Project 1–3 (dari ProjectSeeder)
        $projects = collect([
            Project::find(1),
            Project::find(2),
            Project::find(3),
        ])->filter()->values();

        if ($projects->isEmpty()) {
            $this->command->warn('Tidak ada project. Jalankan ProjectSeeder dulu.');
            return;
        }

        // =====================================================
        // Employee
        // =====================================================
        $employees = User::role('Employee')->get();

        if ($employees->isEmpty()) {
            $this->command->warn('Tidak ada user dengan role Employee. Jalankan UserSeeder dulu.');
            return;
        }

        // =====================================================
        // KESEPAKATAN: category → type
        // =====================================================
        $typesByCategory = [
            'managerial' => [
                'gp-um-ut-fungsi',
                'gp-mahal-um-ut-fungsi',
                'all-in',
            ],
            'non-managerial' => [
                'security',
                'ob',
                'gp-um-ut-laut',
                'gp-um-ut',
                'gp-mahal-um-ut-fungsi',
                'gp-mahal-um-ut-fungsi-pls',
                'gp-mahal-um-ut',
            ],
            'project' => [
                'pep-lokal-buny',
                'elis-phkt-5-2',
                'elis-phkt-6-1',
                'eni-muara-bakau-lembur',
                'eni-muara-bakau-all-in',
                'ipfms-dobu',
            ],
        ];

        $categories = array_keys($typesByCategory);

        // =====================================================
        // Status valid
        // =====================================================
        $statuses = [
            'draft',
            'sent',
            'viewed',
            'signed',
            'signed-hrd',
            'signed-head',
            'expired',
        ];

        // =====================================================
        // Salary range per category
        // =====================================================
        $salaryByCategory = [
            'managerial'     => [9_000_000, 20_000_000],
            'non-managerial' => [3_500_000, 7_000_000],
            'project'        => [5_000_000, 12_000_000],
        ];

        // =====================================================
        // Judul per category (biar tetap masuk akal)
        // =====================================================
        $titlesByCategory = [
            'managerial' => [
                'Perjanjian Kerja — Manager Operasional',
                'Perjanjian Kerja — Senior Supervisor',
                'Perjanjian Kerja — Head of Department',
            ],
            'non-managerial' => [
                'Perjanjian Kerja — Security',
                'Perjanjian Kerja — Office Boy',
                'Perjanjian Kerja — Crew Laut',
                'Perjanjian Kerja — Staff Umum',
            ],
            'project' => [
                'Perjanjian Kerja Proyek — PEP Lokal Bunyu',
                'Perjanjian Kerja Proyek — ELIS PHKT 5-2',
                'Perjanjian Kerja Proyek — ELIS PHKT 6-1',
                'Perjanjian Kerja Proyek — ENI Muara Bakau',
                'Perjanjian Kerja Proyek — IPFMS Dobu',
            ],
        ];

        // Counter nomor kontrak per category+type
        $counter = [];

        // =====================================================
        // Generate 30 contract random
        // =====================================================
        for ($i = 0; $i < 30; $i++) {

            // Employee rotasi
            $employee = $employees[$i % $employees->count()];

            // Random category → random type dari category tsb
            $category = $categories[array_rand($categories)];
            $type     = $typesByCategory[$category][array_rand($typesByCategory[$category])];

            // Counter unik per type
            $counter[$type] = ($counter[$type] ?? 0) + 1;
            $contractNumber = sprintf(
                'CT-%s-%s-%03d',
                strtoupper(preg_replace('/[^a-z0-9]/i', '', $type)),
                now()->format('Y'),
                $counter[$type]
            );

            // Project rotasi
            $project = $projects[$i % $projects->count()];

            // Judul
            $title = $titlesByCategory[$category][array_rand($titlesByCategory[$category])];

            // Status random
            $status = $statuses[array_rand($statuses)];

            // Salary random
            [$min, $max] = $salaryByCategory[$category];
            $basicSalary = rand($min, $max);

            // Periode
            $startDate = now()->subDays(rand(-30, 365))->startOfDay();
            $endDate   = (clone $startDate)->addDays(rand(90, 730));

            // Snapshot employee
            $nik       = '3201' . str_pad((string) ($i + 1), 12, '0', STR_PAD_LEFT);
            $ktpNumber = '3201' . str_pad((string) ($i + 1), 12, '0', STR_PAD_LEFT);

            $birthDate     = now()->subYears(rand(25, 45));
            $ageAtContract = $birthDate->age;

            // Signature
            $employeeSigned = in_array($status, ['signed', 'signed-hrd', 'signed-head', 'expired']);
            $hrdSigned      = in_array($status, ['signed-hrd', 'signed-head']);
            $headSigned     = $status === 'signed-head';

            Contract::create([
                'contract_number' => $contractNumber,
                'contract_date'   => $startDate->format('Y-m-d'),
                'category'        => $category,
                'type'            => $type,
                'title'           => $title,

                // Relation
                'user_id'         => $employee->id,
                'project_id'      => $project->id,
                'head_user_id'    => $gm?->id,
                'hrd_user_id'     => $hrd?->id,

                // Employee snapshot
                'employee_name'   => $employee->name,
                'department'      => $category === 'managerial' ? 'Manajemen' : 'Operasional',
                'nik'             => $nik,
                'ktp_number'      => $ktpNumber,
                'birth_place'     => 'Balikpapan',
                'birth_date'      => $birthDate->format('Y-m-d'),
                'age_at_contract' => $ageAtContract,
                'gender'          => $i % 2 === 0 ? 'male' : 'female',
                'address'         => 'Jl. Contoh No. ' . ($i + 1) . ', Balikpapan',

                // Period
                'start_date'      => $startDate->format('Y-m-d'),
                'end_date'        => $endDate->format('Y-m-d'),

                // Position
                'position'        => $category === 'managerial' ? 'Manager' : 'Staff',
                'work_location'   => $project->location ?? 'Balikpapan',
                'domicile'        => 'Balikpapan',

                // Salary
                'basic_salary'    => $basicSalary,

                // Status
                'status'          => $status,

                // Signature
                'employee_signature' => $employeeSigned
                    ? 'signature/employee-' . $contractNumber . '.png'
                    : null,
                'employee_signed_at' => $employeeSigned
                    ? now()->subDays(rand(5, 30))
                    : null,

                'hrd_signature'      => $hrdSigned
                    ? 'signature/hrd-' . $contractNumber . '.png'
                    : null,
                'hrd_signed_at'      => $hrdSigned
                    ? now()->subDays(rand(2, 10))
                    : null,

                'head_signature'     => $headSigned
                    ? 'signature/head-' . $contractNumber . '.png'
                    : null,
                'head_signed_at'     => $headSigned
                    ? now()->subDays(rand(1, 5))
                    : null,

                // Audit
                'created_by'      => $admin?->id ?? $employee->id,
            ]);
        }

        $this->command->info('ContractSeeder: 30 contract berhasil dibuat (category & type random sesuai kesepakatan).');
    }
}