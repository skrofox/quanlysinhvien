<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModule;
use App\Models\CourseRegistration;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LecturerActionController extends Controller
{
    // Lấy danh sách Lớp học phần do giảng viên này phụ trách trong 1 Học kỳ
    public function getAssignedClasses(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasRole('giang_vien') && !$user->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $lecturer = $user->lecturer;
        if (!$lecturer && !$user->hasRole('admin')) {
            return response()->json(['message' => 'Lecturer profile not found'], 404);
        }

        $semesterId = $request->query('semester_id');

        $query = CourseModule::with(['subject'])
            ->where('lecturer_id', $lecturer ? $lecturer->id : 0);

        if ($semesterId && $semesterId !== 'all') {
            $query->where('semester_id', $semesterId);
        }

        $modules = $query->get()->map(function ($mod) {
            // Đếm số sinh viên đã đăng ký
            $enrolled = CourseRegistration::where('course_module_id', $mod->id)->count();
            return [
                'id' => $mod->id,
                'subject_code' => $mod->subject->subject_code ?? '',
                'subject_name' => $mod->subject->subject_name ?? '',
                'credits' => $mod->subject->number_of_credits ?? 0,
                'capacity' => $mod->capacity,
                'current_enrollment' => $enrolled,
                'semester_id' => $mod->semester_id
            ];
        });

        return response()->json($modules);
    }

    // Lấy danh sách Sinh viên kèm theo Điểm của họ trong 1 Lớp học phần
    public function getClassStudents($courseId)
    {
        $user = Auth::user();
        if (!$user->hasRole('giang_vien') && !$user->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $lecturer = $user->lecturer;

        // Verify that this course module belongs to the lecturer
        $module = CourseModule::find($courseId);
        if (!$module) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        if ($lecturer && $module->lecturer_id !== $lecturer->id) {
            return response()->json(['message' => 'Bạn không được phân công dạy lớp này.'], 403);
        }

        // Fetch students registered for this course module
        $registrations = CourseRegistration::where('course_module_id', $courseId)->get();
        
        $studentsData = [];
        foreach ($registrations as $reg) {
            // $reg->student_id links to user_id of student, let's fetch Student model directly
            $student = Student::where('user_id', $reg->student_id)->first();
            if (!$student) continue;

            // Fetch the grade record
            $grade = Grade::where('student_id', $student->id)
                ->where('course_module_id', $courseId)
                ->first();

            $studentsData[] = [
                'student_id' => $student->id,
                'student_code' => $student->student_code,
                'full_name' => $student->full_name,
                'grade_id' => $grade ? $grade->id : null,
                'attendance_score' => $grade ? $grade->attendance_score : 0,
                'midterm_score' => $grade ? $grade->midterm_score : 0,
                'final_score' => $grade ? $grade->final_score : 0,
                'average_score' => $grade ? $grade->average_score : 0,
                'status' => $grade ? ($grade->status == 'pass' ? 'Đạt' : 'Trượt') : 'Chưa nhập'
            ];
        }

        return response()->json($studentsData);
    }

    // Lưu điểm hàng loạt
    public function saveGrades(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasRole('giang_vien') && !$user->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Validate đầu vào
        $request->validate([
            'course_id' => 'required|exists:course_modules,id',
            'grades' => 'required|array',
            'grades.*.student_id' => 'required|exists:students,id',
            'grades.*.attendance_score' => 'required|numeric|min:0|max:10',
            'grades.*.midterm_score' => 'required|numeric|min:0|max:10',
            'grades.*.final_score' => 'required|numeric|min:0|max:10',
        ]);

        $courseId = $request->input('course_id');
        $studentsGrades = $request->input('grades', []);

        // Verify module
        $module = CourseModule::find($courseId);
        $lecturer = $user->lecturer;

        if (!$module) return response()->json(['message' => 'Lớp học phần không tồn tại.'], 404);
        if ($lecturer && $module->lecturer_id !== $lecturer->id) {
            return response()->json(['message' => 'Bạn không có quyền sửa điểm lớp này.'], 403);
        }

        DB::beginTransaction();
        try {
            foreach ($studentsGrades as $sg) {
                // Find or create grade record
                $grade = Grade::firstOrNew([
                    'student_id' => $sg['student_id'],
                    'course_module_id' => $courseId
                ]);

                // Update scores
                // The Grades model has booted event calculating average & status automatically before save
                $grade->attendance_score = (int) ($sg['attendance_score'] ?? 0);
                $grade->midterm_score = (float) ($sg['midterm_score'] ?? 0);
                $grade->final_score = (float) ($sg['final_score'] ?? 0);
                
                $grade->save();
            }
            DB::commit();
            return response()->json(['message' => 'Lưu bảng điểm thành công!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Lỗi lưu điểm: ' . $e->getMessage()], 500);
        }
    }
}
