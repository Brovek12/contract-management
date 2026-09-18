<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'code' => 'PHSS',
            'name' => 'PHSS',
            'location' => 'Balikpapan',
            'is_active' => true,
        ]);

        Project::create([
            'code' => 'PHM',
            'name' => 'PHM',
            'location' => 'Balikpapan',
            'is_active' => true,
        ]);

        Project::create([
            'code' => 'PHKT',
            'name' => 'PHKT',
            'location' => 'Kalimantan Timur',
            'is_active' => true,
        ]);
    }
}