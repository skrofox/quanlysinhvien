<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseModule;
use App\Models\CourseRegistration;
use App\Models\Grade;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentActionController extends Controller
{
    /**
     * Get list of available courses for the current registration period.
     */
    public function getAvailableCourses()
    {
        $user = Auth::user();
        if (!$user?->hasRole('sinh_vien')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Lấy học kỳ mới nhất (hoặc đang mở đăng ký)
        $latestSemester = Semester::orderBy('id', 'desc')->first();
        if (!$latestSemester) {
            return response()->json([]);
        }

        $courses = CourseModule::with(['subject', 'lecturer'])
            ->where('semester_id', $latestSemester->id)
            ->get()
            ->map(function ($course) use ($user) {
                // Đếm số lượng sinh viên đã đăng ký cho lớp này
                $currentEnrollment = CourseRegistration::where('course_module_id', $course->id)->count();
                
                // Kiểm tra xem sinh viên hiện tại đã đăng ký chưa
                $isRegistered = CourseRegistration::where('course_module_id', $course->id)
                    ->where('student_id', $user->id)
                    ->exists();

                return [
                    'id' => $course->id,
                    'subject_code' => $course->subject->subject_code ?? 'N/A',
                    'subject_name' => $course->subject->subject_name ?? 'N/A',
                    'credits' => $course->subject->number_of_credits ?? 0,
                    'lecturer_name' => $course->lecturer->full_name ?? 'Chưa gán',
                    'capacity' => $course->number_of_students,
                    'current_enrollment' => $currentEnrollment,
                    'is_registered' => $isRegistered,
                    'is_full' => $currentEnrollment >= $course->number_of_students,
                ];
            });

        return response()->json($courses);
    }

    /**
     * Handle course registration (Tín chỉ).
     */
    public function register(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->input('course_id');

        return DB::transaction(function () use ($user, $courseId) {
            $course = CourseModule::findOrFail($courseId);
            
            // 1. Kiểm tra đã đăng ký chưa
            $exists = CourseRegistration::where('student_id', $user->id)
                ->where('course_module_id', $courseId)
                ->exists();
            if ($exists) {
                return response()->json(['message' => 'Bạn đã đăng ký lớp học phần này rồi!'], 422);
            }

            // 2. Kiểm tra sĩ số
            $currentCount = CourseRegistration::where('course_module_id', $courseId)->count();
            if ($currentCount >= $course->number_of_students) {
                return response()->json(['message' => 'Lớp học phần này đã đầy sĩ số!'], 422);
            }

            // 3. Thực hiện đăng ký
            CourseRegistration::create([
                'student_id' => $user->id,
                'course_module_id' => $courseId,
                'registration_date' => now(),
            ]);

            // 4. Đồng thời tạo bản ghi Grade rỗng
            $student = $user->student;
            if ($student) {
                Grade::firstOrCreate([
                    'student_id' => $student->id,
                    'course_module_id' => $courseId,
                ], [
                    'attendance_score' => 0,
                    'midterm_score' => 0,
                    'final_score' => 0,
                    'status' => 'fail',
                    'average_score' => 0,
                ]);
            }

            return response()->json(['message' => 'Đăng ký học phần thành công!']);
        });
    }

    /**
     * Cancel a course registration.
     */
    public function cancelRegistration(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->input('course_id');

        return DB::transaction(function () use ($user, $courseId) {
            $registration = CourseRegistration::where('student_id', $user->id)
                ->where('course_module_id', $courseId)
                ->first();

            if (!$registration) {
                return response()->json(['message' => 'Không tìm thấy thông tin đăng ký!'], 422);
            }

            $registration->delete();

            // Xóa điểm tương ứng
            $student = $user->student;
            if ($student) {
                Grade::where('student_id', $student->id)
                    ->where('course_module_id', $courseId)
                    ->delete();
            }

            return response()->json(['message' => 'Hủy đăng ký học phần thành công!']);
        });
    }

    /**
     * Get list of students in a specific course.
     */
    public function getCourseStudents($courseId)
    {
        $students = DB::table('course_registrations')
            ->join('students', 'course_registrations.student_id', '=', 'students.user_id')
            ->join('school_classes', 'students.school_class_id', '=', 'school_classes.id')
            ->where('course_registrations.course_module_id', $courseId)
            ->select('students.full_name', 'students.student_code', 'school_classes.class_name')
            ->orderBy('students.full_name', 'asc')
            ->get();

        return response()->json($students);
    }
}
