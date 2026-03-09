<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("academic_years")->insert([
            ['start_year' => 2023, 'end_year' => 2027],
            ['start_year' => 2024, 'end_year' => 2028],
            ['start_year' => 2025, 'end_year' => 2029],
        ]);
    }
}
