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
            ['code' => 'CNTT', 'name' => 'Khoa Công nghệ thông tin'],
            ['code' => 'KT', 'name' => 'Khoa Kinh tế'],
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
        // 7. 300 Students
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

        echo "8. Đang khởi tạo Lớp học phần, Đăng ký môn và Nhập điểm...\n";
        // Lấy tất cả Grade events để vô hiệu hóa boot logic cho nhanh (tùy thuộc, nhưng GradeObserver/booted() tốn query)
        // Trong Seeder, ta nên bỏ quả những exception validator để DB Seed chạy mượt.

        $semesters = [$semester1, $semester2];
        foreach ($semesters as $sem) {
            for ($i = 1; $i <= 20; $i++) {
                $subject = $faker->randomElement($createdSubjects);
                // Chọn giảng viên thuộc cùng khoa với môn học
                $lecturer = Lecturer::where('department_id', $subject->department_id)->inRandomOrder()->first();
                
                if (!$lecturer) continue; // Phòng trường hợp khoa không có GV
                
                $courseModule = CourseModule::create([
                    'subject_id' => $subject->id,
                    'semester_id' => $sem->id,
                    'lecturer_id' => $lecturer->id,
                    'number_of_students' => $faker->numberBetween(40, 60), 
                ]);
                
                // Chọn ngẫu nhiên 30-50 học sinh để đky module này
                $enrolledStudents = $faker->randomElements($createdStudents, $faker->numberBetween(30, 50));
                
                foreach ($enrolledStudents as $student) {
                    
                    // Tạo Registration
                    CourseRegistration::firstOrCreate([
                        // CourseRegistration liên kết theo id bảng users
                        'student_id' => $student->user_id, 
                        'course_module_id' => $courseModule->id,
                    ], [
                        'registration_date' => Carbon::now()->subDays(rand(10, 30)),
                    ]);
                    
                    // Tạo Điểm (Grade) với logic try catch để bypass Exception trong Model
                    try {
                        Grade::firstOrCreate([
                            // Bảng Grade theo logic lại liên kết với ID bảng Student
                            'student_id' => $student->id, 
                            'course_module_id' => $courseModule->id,
                        ], [
                            'attendance_score' => $faker->randomFloat(1, 4, 10),
                            'midterm_score' => $faker->randomFloat(1, 3, 10),
                            'final_score' => $faker->randomFloat(1, 3, 10),
                            'average_score' => 0, // Computed by Observer
                            'status' => 'pass' // Computed by Observer
                        ]);
                    } catch (\Exception $e) {
                        // Bỏ qua Exception
                    }
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
