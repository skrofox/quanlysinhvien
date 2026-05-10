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
                'semester_id' => $mod->semester_id,
                'is_completed' => (bool)$mod->is_completed
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
            $student = Student::where('user_id', $reg->student_id)->first();
            if (!$student) continue;

            // Lấy điểm chi tiết (DCC, DGK, DCK)
            $detailedGrade = \App\Models\GradeCourseModule::where('student_id', $student->id)
                ->where('course_module_id', $courseId)
                ->first();

            // Lấy điểm tổng hợp (L1, L2, L3, L4)
            $grade = Grade::where('student_id', $student->id)
                ->where('course_module_id', $courseId)
                ->first();

            $statusText = 'Chưa nhập điểm';
            if ($detailedGrade) {
                if ($detailedGrade->DCC == 0 && $detailedGrade->DGK == 0 && $detailedGrade->DCK == 0) {
                    $statusText = 'Chưa nhập điểm';
                } else {
                    $statusText = ($grade && $grade->status == 'pass' ? 'Đạt' : 'Trượt');
                }
            }

            $studentsData[] = [
                'student_id' => $student->id,
                'student_code' => $student->student_code,
                'full_name' => $student->full_name,
                'detailed_id' => $detailedGrade ? $detailedGrade->id : null,
                'DCC' => $detailedGrade ? $detailedGrade->DCC : 0,
                'DGK' => $detailedGrade ? $detailedGrade->DGK : 0,
                'DCK' => $detailedGrade ? $detailedGrade->DCK : 0,
                'is_finalized' => $detailedGrade ? (bool)$detailedGrade->is_finalized : false,
                'L1' => $grade ? $grade->L1 : null,
                'L2' => $grade ? $grade->L2 : null,
                'L3' => $grade ? $grade->L3 : null,
                'L4' => $grade ? $grade->L4 : null,
                'average_score' => $grade ? $grade->average_score : 0,
                'status' => $statusText,
                'isComplete' => (bool)$reg->isComplete
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
            'grades.*.DCC' => 'nullable|numeric|min:0|max:10',
            'grades.*.DGK' => 'nullable|numeric|min:0|max:10',
            'grades.*.DCK' => 'nullable|numeric|min:0|max:10',
            'grades.*.isComplete' => 'nullable|boolean',
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
            $lockedCount = 0;
            foreach ($studentsGrades as $sg) {
                // 1. Tìm bản ghi điểm chi tiết
                $detailedGrade = \App\Models\GradeCourseModule::firstOrNew([
                    'student_id' => $sg['student_id'],
                    'course_module_id' => $courseId
                ]);

                $detailedGrade->DCC = (float)($sg['DCC'] ?? 0);
                $detailedGrade->DGK = (float)($sg['DGK'] ?? 0);
                $detailedGrade->DCK = (float)($sg['DCK'] ?? 0);
                $detailedGrade->semester_id = $module->semester_id;

                // Kiểm tra xem có đánh dấu hoàn thành không
                $isComplete = $sg['isComplete'] ?? false;

                $detailedGrade->is_finalized = $isComplete;

                $detailedGrade->save();

                // Cập nhật sang bảng Grade (L1-L4) và CourseRegistration
                // 1. Update CourseRegistration isComplete
                    $studentUser = Student::find($sg['student_id']);
                    if ($studentUser) {
                        CourseRegistration::where('student_id', $studentUser->user_id)
                            ->where('course_module_id', $courseId)
                            ->update(['isComplete' => $isComplete]);
                    }

                    // Tính điểm trung bình của lần học này
                    $avg = round(($detailedGrade->DCC * 0.1) + ($detailedGrade->DGK * 0.3) + ($detailedGrade->DCK * 0.6), 1);

                    $subjectId = $module->subject_id;

                    // Tìm bản ghi Grade DUY NHẤT của sinh viên đối với môn học này
                    $grade = Grade::where('student_id', $sg['student_id'])
                        ->whereHas('courseModule', function($q) use ($subjectId) {
                            $q->where('subject_id', $subjectId);
                        })->first();

                    if (!$grade) {
                        $grade = new Grade();
                        $grade->student_id = $sg['student_id'];
                    }
                    
                    // Cập nhật để luôn trỏ tới lớp học phần mới nhất
                    $grade->course_module_id = $courseId;

                    // Xác định lần học (L1, L2, L3, L4) dựa trên lịch sử đăng ký
                    $attemptCount = CourseRegistration::where('student_id', $studentUser->user_id)
                        ->whereHas('courseModule', function($q) use ($subjectId) {
                            $q->where('subject_id', $subjectId);
                        })->count();

                    $column = 'L' . min(max($attemptCount, 1), 4);
                    $grade->$column = $avg;
                    $grade->attendance_score = $detailedGrade->DCC;
                    $grade->save();

            }

            // Logic tự động đóng lớp học phần
            $totalStudents = \App\Models\CourseRegistration::where('course_module_id', $courseId)->count();
            $completedStudents = \App\Models\CourseRegistration::where('course_module_id', $courseId)
                ->where('isComplete', true)->count();
            
            if ($totalStudents > 0 && $totalStudents === $completedStudents) {
                $module->is_completed = true;
                $module->save();
            } else {
                // Nếu chưa đủ (ví dụ bỏ tick) thì có thể mở lại lớp tự động
                if ($module->is_completed) {
                    $module->is_completed = false;
                    $module->save();
                }
            }

            DB::commit();

            $msg = 'Lưu bảng điểm thành công!';
            if ($lockedCount > 0) {
                $msg .= " (Có $lockedCount sinh viên đã chốt điểm trước đó nên không thể thay đổi)";
            }
            return response()->json(['message' => $msg]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Lỗi lưu điểm: ' . $e->getMessage()], 500);
        }
    }

    // Thêm sinh viên vào lớp học phần bằng mã sinh viên
    public function addStudentToClass(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasRole('giang_vien') && !$user->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'course_id' => 'required|exists:course_modules,id',
            'student_code' => 'required|string|exists:students,student_code',
        ]);

        $courseId = $request->input('course_id');
        $studentCode = $request->input('student_code');

        // Verify module ownership
        $module = CourseModule::find($courseId);
        $lecturer = $user->lecturer;

        if (!$module) return response()->json(['message' => 'Lớp học phần không tồn tại.'], 404);
        if ($lecturer && $module->lecturer_id !== $lecturer->id) {
            return response()->json(['message' => 'Bạn không có quyền thêm sinh viên vào lớp này.'], 403);
        }

        // Find student
        $student = Student::where('student_code', $studentCode)->first();
        if (!$student) return response()->json(['message' => 'Sinh viên không tồn tại.'], 404);

        // Check if student is already in the class
        $exists = CourseRegistration::where('student_id', $student->user_id)
            ->where('course_module_id', $courseId)
            ->exists();
        if ($exists) {
            return response()->json(['message' => 'Sinh viên này đã đăng ký học tại lớp này.'], 400);
        }

        DB::beginTransaction();
        try {
            // 1. Create CourseRegistration (student_id links to user_id)
            $registration = CourseRegistration::create([
                'student_id' => $student->user_id,
                'course_module_id' => $courseId,
                'registration_date' => now()
            ]);

            // 2. Create or get Grade (student_id links to students.id)
            $subjectId = $module->subject_id;
            $existingGrade = Grade::where('student_id', $student->id)
                ->whereHas('courseModule', function($q) use ($subjectId) {
                    $q->where('subject_id', $subjectId);
                })->first();

            if ($existingGrade) {
                $existingGrade->update(['course_module_id' => $courseId]);
            } else {
                Grade::create([
                    'student_id' => $student->id,
                    'course_module_id' => $courseId,
                    'attendance_score' => 0,
                    'average_score' => 0,
                    'status' => 'pending'
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Thêm sinh viên ' . $student->full_name . ' thành công!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }

    // Xóa sinh viên khỏi lớp
    public function removeStudentFromClass(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasRole('giang_vien') && !$user->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'course_id' => 'required|exists:course_modules,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $courseId = $request->input('course_id');
        $studentId = $request->input('student_id');

        // Verify ownership
        $module = CourseModule::find($courseId);
        $lecturer = $user->lecturer;

        if ($lecturer && $module->lecturer_id !== $lecturer->id) {
            return response()->json(['message' => 'Bạn không có quyền xóa sinh viên lớp này.'], 403);
        }

        $student = Student::find($studentId);

        DB::beginTransaction();
        try {
            // 1. Xóa Bảng điểm
            Grade::where('student_id', $studentId)
                ->where('course_module_id', $courseId)
                ->delete();

            // 2. Xóa Đăng ký (student_id trong table CourseRegistration là user_id)
            CourseRegistration::where('student_id', $student->user_id)
                ->where('course_module_id', $courseId)
                ->delete();

            DB::commit();
            return response()->json(['message' => 'Đã xóa sinh viên khỏi lớp thành công.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Lỗi xóa sinh viên: ' . $e->getMessage()], 500);
        }
    }
    public function toggleCourseCompletion(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasRole('giang_vien') && !$user->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'course_id' => 'required|exists:course_modules,id',
        ]);

        $module = CourseModule::find($request->course_id);
        $lecturer = $user->lecturer;

        if ($lecturer && $module->lecturer_id !== $lecturer->id) {
            return response()->json(['message' => 'Bạn không có quyền thao tác trên lớp này.'], 403);
        }

        $module->is_completed = !$module->is_completed;
        $module->save();

        return response()->json([
            'message' => $module->is_completed ? 'Đã đóng lớp học phần.' : 'Đã mở lại lớp học phần.',
            'is_completed' => $module->is_completed
        ]);
    }
}
