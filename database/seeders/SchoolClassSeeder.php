<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Department;
use App\Models\SchoolClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::pluck('id', 'department_code')->toArray();

        $academicYears = AcademicYear::pluck('id', 'start_year')->toArray();

        $classes = [
            ["code" => "CNTT1-23", "dept" => "THNN", "year" => 2023],
            ["code" => "CNTT2-23", "dept" => "THNN", "year" => 2023],
            ["code" => "KT1-23",   "dept" => "KT",   "year" => 2023],
            ["code" => "KT2-23",   "dept" => "KT",   "year" => 2023],
            ["code" => "QTKS1-23", "dept" => "DL",   "year" => 2023],
            ["code" => "DLLH1-23", "dept" => "DL",   "year" => 2023],

            ["code" => "CNTT1-24", "dept" => "THNN", "year" => 2024],
            ["code" => "CNTT2-24", "dept" => "THNN", "year" => 2024],
            ["code" => "KT1-24",   "dept" => "KT",   "year" => 2024],
            ["code" => "KT2-24",   "dept" => "KT",   "year" => 2024],
            ["code" => "QTKS1-24", "dept" => "DL",   "year" => 2024],
            ["code" => "DLLH1-24", "dept" => "DL",   "year" => 2024],

            ["code" => "CNTT1-25", "dept" => "THNN", "year" => 2025],
            ["code" => "CNTT2-25", "dept" => "THNN", "year" => 2025],
            ["code" => "KT1-25",   "dept" => "KT",   "year" => 2025],
            ["code" => "KT2-25",   "dept" => "KT",   "year" => 2025],
            ["code" => "QTKS1-25", "dept" => "DL",   "year" => 2025],
            ["code" => "DLLH1-25", "dept" => "DL",   "year" => 2025],
        ];

        $data = [];
        foreach ($classes as $class) {
            if (!isset($departments[$class['dept']])) {
                throw new \Exception("Department code {$class['dept']} chưa tồn tại");
            }
            if (!isset($academicYears[$class['year']])) {
                throw new \Exception("Academic year {$class['year']} chưa tồn tại");
            }

            $data[] = [
                'class_code'     => $class['code'],
                'class_name'     => 'Unknown',
                'department_id'  => $departments[$class['dept']],
                'academic_year_id' => $academicYears[$class['year']],
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        SchoolClass::insert($data);
    }
}
