<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("departments")->insert([
            ['department_code' => 'THNN', 'department_name' => "Tin Học Ngoại ngữ"],
            ['department_code' => "KT", "department_name" => "Kinh Tế"],
            ['department_code' => "DL", "department_name" => "Du Lịch"],
        ]);
    }
}
