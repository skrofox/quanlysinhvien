<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Department;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Models\AcademicBatch;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\CourseModule;
use App\Models\CourseRegistration;
use App\Models\Grade;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        echo "1. Đang khởi tạo Roles...\n";
        // 1. Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $lecturerRole = Role::firstOrCreate(['name' => 'giang_vien', 'guard_name' => 'web']);
        $studentRole = Role::firstOrCreate(['name' => 'sinh_vien', 'guard_name' => 'web']);

        echo "2. Đang khởi tạo User Admin...\n";
        // 2. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        echo "3. Đang khởi tạo Khoa...\n";
        // 3. Departments
        $departments = [
            ['code' => 'THNN', 'name' => 'Khoa Tin Học Ngoại Ngữ'],
            ['code' => 'QTKD', 'name' => 'Khoa Quản Trị Kinh Doanh'],
            ['code' => 'NN', 'name' => 'Khoa Ngoại ngữ'],
            ['code' => 'DT', 'name' => 'Khoa Điện tử - Viễn thông'],
            ['code' => 'CK', 'name' => 'Khoa Cơ khí'],
        ];
        $createdDepartments = [];
        foreach ($departments as $dept) {
            $createdDepartments[] = Department::firstOrCreate(
                ['department_code' => $dept['code']],
                ['department_name' => $dept['name']]
            );
        }

        echo "4. Đang khởi tạo Khóa học và Năm học...\n";
        // 4. AcademicBatch (Khóa học - 4 năm) & SchoolYear (Năm học - 1 năm)
        $academicBatch = AcademicBatch::firstOrCreate(['start_year' => '2022'], ['end_year' => '2026']);
        $schoolYear = SchoolYear::firstOrCreate(['start_year' => '2025'], ['end_year' => '2026']);

        $semester1 = Semester::firstOrCreate(['semester_name' => 'Học kỳ 1'], ['school_year_id' => $schoolYear->id]);
        $semester2 = Semester::firstOrCreate(['semester_name' => 'Học kỳ 2'], ['school_year_id' => $schoolYear->id]);

        echo "5. Đang khởi tạo Lớp sinh hoạt và Môn học...\n";
        // 5. School Classes & Subjects per Department
        $createdClasses = [];
        $createdSubjects = [];

        foreach ($createdDepartments as $dept) {
            // 2 classes per department
            for ($i = 1; $i <= 2; $i++) {
                $createdClasses[] = SchoolClass::firstOrCreate(
                    ['class_code' => $dept->department_code . '0' . $i],
                    [
                        'class_name' => 'Lớp ' . $dept->department_code . ' ' . $i,
                        'department_id' => $dept->id,
                        'academic_batch_id' => $academicBatch->id,
                    ]
                );
            }

            // 5 subjects per department
            for ($i = 1; $i <= 5; $i++) {
                $createdSubjects[] = Subject::firstOrCreate(
                    ['subject_code' => $dept->department_code . '10' . $i],
                    [
                        'subject_name' => 'Môn học ' . $i . ' (' . $dept->department_code . ')',
                        'number_of_credits' => $faker->numberBetween(2, 4),
                        'department_id' => $dept->id,
                    ]
                );
            }
        }

        echo "6. Đang tạo 30 Giảng viên (phân bổ theo Khoa)...\n";
        // 6. 30 Lecturers (6 per department)
        $createdLecturers = [];
        $gvCount = 1;
        foreach ($createdDepartments as $dept) {
            for ($i = 1; $i <= 6; $i++) {
                $user = User::firstOrCreate(
                    ['email' => 'gv' . $gvCount . '@gmail.com'],
                    [
                        'name' => 'Giảng viên ' . $gvCount . ' (' . $faker->lastName . ' ' . $faker->firstName . ')',
                        'password' => Hash::make('password'),
                        'email_verified_at' => now(),
                    ]
                );
                $user->assignRole($lecturerRole);

                $createdLecturers[] = Lecturer::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'lecturer_code' => 'GV2025' . str_pad($gvCount, 3, '0', STR_PAD_LEFT),
                        'full_name' => $user->name,
                        'birthday' => $faker->date('Y-m-d', '1990-01-01'),
                        'gender' => $faker->randomElement(['Nam', 'Nữ']),
                        'phone' => $faker->numerify('09########'),
                        'address' => $faker->address,
                        'department_id' => $dept->id,
                    ]
                );
                $gvCount++;
            }
        }

        echo "7. Đang tạo 300 Sinh viên...\n";
        $createdStudents = [];
        for ($i = 1; $i <= 300; $i++) {
            $user = User::firstOrCreate(
                ['email' => 'sv' . $i . '@gmail.com'],
                [
                    'name' => 'Sinh viên ' . $i . ' (' . $faker->lastName . ' ' . $faker->firstName . ')',
                    'password' => Hash::make('password'), // Pass mặc định: password
                    'email_verified_at' => now(),
                ]
            );
            $user->assignRole($studentRole);

            $class = $faker->randomElement($createdClasses);

            $createdStudents[] = Student::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'student_code' => 'SV' . $academicBatch->start_year . str_pad($i, 4, '0', STR_PAD_LEFT),
                    'full_name' => $user->name,
                    'birthday' => $faker->date('Y-m-d', '2004-01-01'),
                    'gender' => $faker->randomElement(['Nam', 'Nữ']),
                    'school_class_id' => $class->id,
                    'CCCD' => $faker->numerify('0#######000#'),
                ]
            );
        }

        echo "8. Đang khởi tạo Lớp học phần, Lịch học, Đăng ký và Nhập điểm...\n";
        $semesters = [$semester1, $semester2];
        foreach ($semesters as $sem) {
            for ($i = 1; $i <= 15; $i++) {
                $subject = $faker->randomElement($createdSubjects);
                $lecturer = Lecturer::where('department_id', $subject->department_id)->inRandomOrder()->first();
                
                if (!$lecturer) continue;
                
                // 1. Course Module
                $courseModule = CourseModule::create([
                    'subject_id' => $subject->id,
                    'semester_id' => $sem->id,
                    'lecturer_id' => $lecturer->id,
                    'number_of_students' => $faker->numberBetween(40, 60), 
                ]);

                // 2. Schedule for this module
                $schedule = \App\Models\Schedule::create([
                    'course_module_id' => $courseModule->id,
                    $faker->randomElement(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday']) => $faker->randomElement(['07:00 - 09:00', '09:00 - 11:00', '13:00 - 15:00', '15:00 - 17:00']) . ', Phòng ' . $faker->randomElement(['A101', 'B202', 'C303', 'D404']),
                ]);
                
                // 3. Registrations & Grades
                $enrolledStudents = $faker->randomElements($createdStudents, $faker->numberBetween(20, 40));
                foreach ($enrolledStudents as $student) {
                    // Registration
                    CourseRegistration::create([
                        'student_id' => $student->user_id, 
                        'course_module_id' => $courseModule->id,
                        'registration_date' => Carbon::now()->subDays(rand(1, 30)),
                        'is_registered' => $faker->boolean(80), // 80% đã duyệt
                        'schedule_id' => $schedule->id,
                    ]);

                    // Attempt 1 (L1)
                    $dcc1 = $faker->randomFloat(1, 7, 10);
                    $dgk1 = $faker->randomFloat(1, 4, 10);
                    $dck1 = $faker->randomFloat(1, 3, 10);
                    $l1_score = round(($dcc1 * 0.1) + ($dgk1 * 0.3) + ($dck1 * 0.6), 1);

                    \App\Models\GradeCourseModule::create([
                        'student_id' => $student->id,
                        'course_module_id' => $courseModule->id,
                        'semester_id' => $sem->id,
                        'DCC' => $dcc1,
                        'DGK' => $dgk1,
                        'DCK' => $dck1,
                    ]);

                    $l2_score = null;
                    // Nếu L1 < 5, có 50% khả năng thi lại (L2)
                    if ($l1_score < 5 && $faker->boolean(50)) {
                        $dcc2 = $dcc1; // Thường chuyên cần giữ nguyên
                        $dgk2 = $dgk1; // Giữa kỳ giữ nguyên
                        $dck2 = $faker->randomFloat(1, 5, 10); // Lần 2 thi tốt hơn
                        $l2_score = round(($dcc2 * 0.1) + ($dgk2 * 0.3) + ($dck2 * 0.6), 1);

                        \App\Models\GradeCourseModule::create([
                            'student_id' => $student->id,
                            'course_module_id' => $courseModule->id,
                            'semester_id' => $sem->id, // Có thể là học kỳ sau nhưng để demo ta để cùng HK
                            'DCC' => $dcc2,
                            'DGK' => $dgk2,
                            'DCK' => $dck2,
                        ]);
                    }

                    // Summary Grade
                    Grade::create([
                        'student_id' => $student->id,
                        'course_module_id' => $courseModule->id,
                        'academic_batch_id' => $student->schoolClass->academic_batch_id,
                        'attendance_score' => $dcc1,
                        'L1' => $l1_score,
                        'L2' => $l2_score,
                        'average_score' => max($l1_score, $l2_score ?? 0),
                        'status' => (max($l1_score, $l2_score ?? 0) >= 5) ? 'pass' : 'fail',
                    ]);
                }
            }
        }

        echo "\nHOÀN THÀNH SEEDING DỮ LIỆU!!!\n";
        echo "=================================\n";
        echo "Tài khoản Admin: admin@gmail.com / admin123\n";
        echo "Tài khoản Giảng viên mẫu: gv1@gmail.com / password\n";
        echo "Tài khoản Sinh viên mẫu: sv1@gmail.com / password\n";
    }
}
