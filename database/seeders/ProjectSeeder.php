<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
{
    Project::create([
        'code' => 'PEP',
        'name' => 'PEP Project - Lokal Bunyu',
        'location' => 'Bunyu',
        'owner' => 'PEP',
        'is_active' => true,
    ]);

    Project::create([
        'code' => 'PHKT-ELIS-52',
        'name' => 'ELIS PHKT Project - Bukaka Balikpapan 5.2',
        'location' => 'Balikpapan',
        'owner' => 'PHKT',
        'is_active' => true,
    ]);

    Project::create([
        'code' => 'PHKT-ELIS-61',
        'name' => 'ELIS PHKT Project - Bukaka Balikpapan 6.1',
        'location' => 'Balikpapan',
        'owner' => 'PHKT',
        'is_active' => true,
    ]);

    Project::create([
        'code' => 'ENI-LEMBUR',
        'name' => 'ENI Muara Bakau Project - Bukaka Balikpapan (Lembur)',
        'location' => 'Balikpapan',
        'owner' => 'ENI',
        'is_active' => true,
    ]);

    Project::create([
        'code' => 'ENI-PC',
        'name' => 'ENI Muara Bakau Project - All in Gaji 25 Project Control',
        'location' => 'Balikpapan',
        'owner' => 'ENI',
        'is_active' => true,
    ]);

    Project::create([
        'code' => 'IPFMS-DOBU',
        'name' => 'IPFMS-DOBU 2026',
        'location' => 'Balikpapan',
        'owner' => 'IPFMS-DOBU',
        'is_active' => true,
    ]);

    // Existing projects
    Project::create([
        'code' => 'PHSS',
        'name' => 'PHSS',
        'location' => 'Balikpapan',
        'owner' => 'PHSS',
        'is_active' => true,
    ]);

    Project::create([
        'code' => 'PHM',
        'name' => 'PHM',
        'location' => 'Balikpapan',
        'owner' => 'PHM',
        'is_active' => true,
    ]);

    Project::create([
        'code' => 'PHKT',
        'name' => 'PHKT',
        'location' => 'Kalimantan Timur',
        'owner' => 'PHKT',
        'is_active' => true,
    ]);
}
}