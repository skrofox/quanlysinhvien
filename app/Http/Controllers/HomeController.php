<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Semester;

use App\Models\News;

class HomeController extends Controller
{
    public function home()
    {
        $featuredNews = News::with('category')
            ->where('status', 'published')
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        $latestNews = News::with('category')
            ->where('status', 'published')
            ->when($featuredNews, function($query) use ($featuredNews) {
                return $query->where('id', '!=', $featuredNews->id);
            })
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('index', compact('featuredNews', 'latestNews'));
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user?->hasRole('sinh_vien')) {
            return redirect()->route('login');
        }

        // Truy xuất Sinh viên cùng với Điểm, Lớp học phần, Môn học, Học kỳ, Khóa học
        $student = $user->student()->with([
            'grades.courseModule.subject', 
            'grades.courseModule.semester',
            'schoolClass.academicBatch'
        ])->first();

        $totalCredits = 0;
        $totalWeightedScore10 = 0;
        $groupedGrades = collect();

        // Lấy tất cả học kỳ để làm Dropdown filter
        $semesters = Semester::with('schoolYear')->orderBy('id', 'desc')->get();

        if ($student && $student->grades) {
            foreach ($student->grades as $grade) {
                $credits = $grade->courseModule->subject->number_of_credits ?? 0;

                // Môn qua (pass) thì mới được cộng tín chỉ tích lũy
                if ($grade->status === 'pass' && $grade->average_score >= 4.0) {
                    $totalCredits += $credits;
                    $totalWeightedScore10 += ($grade->average_score * $credits);
                }
            }

            // Nhóm danh sách điểm theo semester_id để hiển thị ở view
            $groupedGrades = $student->grades->groupBy(function ($grade) {
                return $grade->courseModule->semester_id;
            });
        }

        // Tính GPA hệ 10
        $gpa10 = $totalCredits > 0 ? round($totalWeightedScore10 / $totalCredits, 2) : 0;

        // CĐ hệ 4 (Công thức xấp xỉ tham khảo bằng mức quy đổi tỷ lệ)
        $gpa4 = 0;
        if ($gpa10 >= 8.5)
            $gpa4 = round(4.0, 2);
        elseif ($gpa10 >= 7.0)
            $gpa4 = round(3.0 + ($gpa10 - 7.0) / 1.5 * 0.9, 2);
        elseif ($gpa10 >= 5.5)
            $gpa4 = round(2.0 + ($gpa10 - 5.5) / 1.5 * 0.9, 2);
        elseif ($gpa10 >= 4.0)
            $gpa4 = round(1.0 + ($gpa10 - 4.0) / 1.5 * 0.9, 2);

        // Lấy lịch học cho sinh viên (theo khóa học hoặc không gán khóa học)
        $studentBatchId = $student->schoolClass->academic_batch_id ?? null;

        $schedules = \App\Models\Schedule::with('semester')
            ->where('is_active', true)
            ->where(function($query) use ($studentBatchId) {
                if ($studentBatchId) {
                    $query->where('academic_batch_id', $studentBatchId)
                          ->orWhereNull('academic_batch_id');
                } else {
                    $query->whereNull('academic_batch_id');
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Lấy lịch học của các khóa KHÁC
        $otherSchedules = \App\Models\Schedule::with(['semester', 'academicBatch'])
            ->where('is_active', true)
            ->where(function($query) use ($studentBatchId) {
                if ($studentBatchId) {
                    $query->where('academic_batch_id', '!=', $studentBatchId)
                          ->whereNotNull('academic_batch_id');
                } else {
                    $query->whereNotNull('academic_batch_id');
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.index', compact('user', 'student', 'totalCredits', 'gpa10', 'gpa4', 'groupedGrades', 'semesters', 'schedules', 'otherSchedules'));
    }

    public function giang_vien()
    {
        $user = Auth::user();

        // Đảm bảo chỉ Lecturer hoặc Admin mới vào trang này (Admin xem với tư cách Test)
        if (!$user->hasRole('giang_vien') && !$user->hasRole('admin')) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $lecturer = $user->lecturer;

        // Nếu admin test nhưng chưa tự assign lecturer profile, văng lỗi nhẹ
        if (!$lecturer && !$user->hasRole('admin')) {
            abort(404, 'Không tìm thấy hồ sơ giảng viên.');
        }

        // Lấy danh sách ID các semester để làm filter sau này
        $semesters = \App\Models\Semester::with('schoolYear')->orderByDesc('id')->get();
        // Mặc định lấy Học kỳ gần nhất đang active
        $latestSemester = $semesters->first();

        // Các thống kê hiển thị trên Dashboard Tổng quan
        $totalModules = 0;
        $totalStudents = 0;

        if ($lecturer) {
            $modules = \App\Models\CourseModule::where('lecturer_id', $lecturer->id)
                ->where('semester_id', $latestSemester->id ?? 0)
                ->get();
            $totalModules = $modules->count();
            // Tổng sinh viên đã đăng ký vào các lớp của GV này trong kỳ
            $totalStudents = \App\Models\CourseRegistration::whereIn('course_module_id', $modules->pluck('id'))->count();
        }

        return view('lecturer.index', compact('user', 'lecturer', 'semesters', 'latestSemester', 'totalModules', 'totalStudents'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Mật khẩu hiện tại không chính xác!', 'success' => false], 400);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Đổi mật khẩu thành công!', 'success' => true]);
    }
}
