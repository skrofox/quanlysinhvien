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
     * Get categorized subjects for registration.
     */
    public function getAvailableCourses()
    {
        $user = Auth::user();
        if (!$user?->hasRole('sinh_vien')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $student = $user->student()->with('schoolClass')->first();
        if (!$student) {
            return response()->json(['error' => 'Không tìm thấy hồ sơ sinh viên cho tài khoản này.'], 404);
        }

        $schoolClass = $student->schoolClass;
        if (!$schoolClass || !$schoolClass->department_id) {
            return response()->json(['error' => 'Sinh viên chưa được gán lớp hoặc khoa. Vui lòng liên hệ quản trị viên.'], 422);
        }

        $departmentId = $schoolClass->department_id;

        // 1. Lấy tất cả môn học thuộc khoa của sinh viên
        $subjects = \App\Models\Subject::where('department_id', $departmentId)->get();

        // 2. Lấy học kỳ hiện tại
        $latestSemester = Semester::orderBy('id', 'desc')->first();
        if (!$latestSemester) {
            return response()->json(['error' => 'Hiện không có học kỳ nào đang mở.'], 422);
        }

        // 3. Lấy tất cả điểm chi tiết của sinh viên
        $detailedGrades = \App\Models\GradeCourseModule::where('student_id', $student->id)
            ->with('courseModule.subject')
            ->get()
            ->groupBy(fn($item) => $item->courseModule->subject_id);

        // 4. Lấy các lớp học phần đang mở trong kỳ này
        $activeModules = CourseModule::with(['subject', 'lecturer', 'schedule'])
            ->where('semester_id', $latestSemester->id)
            ->get()
            ->groupBy('subject_id');

        $categories = [
            'first_time' => [],
            'retake' => [],
            'improvement' => [],
            'ongoing' => []
        ];

        foreach ($subjects as $subject) {
            $subjectGrades = $detailedGrades->get($subject->id, collect());
            
            // Tìm bản ghi đang học hoặc mới nhất chưa hoàn thành
            // "Chưa hoàn thành" = có ít nhất 1 cột null HOẶC chưa chốt
            $ongoingGrade = $subjectGrades->first(function($g) {
                return $g->is_finalized == 0 || is_null($g->DCC) || is_null($g->DGK) || is_null($g->DCK);
            });

            // Tìm bản ghi đã hoàn thành tốt nhất (để hiển thị điểm cũ nếu có)
            $bestFinalizedGrade = $subjectGrades->where('is_finalized', 1)
                ->whereNotNull('DCC')
                ->whereNotNull('DGK')
                ->whereNotNull('DCK')
                ->sortByDesc(function($g) {
                    return ($g->DCC + $g->DGK + ($g->DCK * 2)) / 4;
                })->first();


            // Lấy Grade tổng quát mới nhất
            $summaryGrade = Grade::where('student_id', $student->id)
                ->whereHas('courseModule', fn($q) => $q->where('subject_id', $subject->id))
                ->orderBy('id', 'desc')
                ->first();

            $modules = $activeModules->get($subject->id);
            
            $data = [
                'subject_id' => $subject->id,
                'subject_name' => $subject->subject_name,
                'subject_code' => $subject->subject_code,
                'credits' => $subject->number_of_credits,
                'L1' => $summaryGrade ? $summaryGrade->L1 : null,
                'L2' => $summaryGrade ? $summaryGrade->L2 : null,
                'L3' => $summaryGrade ? $summaryGrade->L3 : null,
                'L4' => $summaryGrade ? $summaryGrade->L4 : null,
                'average_score' => $summaryGrade ? $summaryGrade->average_score : null,
                'has_modules' => $modules ? $modules->count() > 0 : false,
                'is_ongoing' => (bool)$ongoingGrade,

                'modules' => $modules ? $modules->map(function($m) use ($user) {
                    $reg = CourseRegistration::where('course_module_id', $m->id)
                        ->where('student_id', $user->id)
                        ->first();
                    return [
                        'id' => $m->id,
                        'lecturer' => $m->lecturer->full_name ?? 'N/A',
                        'capacity' => $m->number_of_students,
                        'current' => CourseRegistration::where('course_module_id', $m->id)->count(),
                        'is_registered' => (bool)$reg,
                        'schedule' => $m->schedule ? [
                            'monday' => $m->schedule->monday,
                            'tuesday' => $m->schedule->tuesday,
                            'wednesday' => $m->schedule->wednesday,
                            'thursday' => $m->schedule->thursday,
                            'friday' => $m->schedule->friday,
                            'saturday' => $m->schedule->saturday,
                        ] : null
                    ];
                }) : []
            ];

            // Phân loại
            if ($ongoingGrade) {
                $categories['ongoing'][] = $data;
            } elseif ($subjectGrades->isEmpty()) {
                $categories['first_time'][] = $data;
            } elseif ($summaryGrade && $summaryGrade->average_score < 4.0) {
                $categories['retake'][] = $data;
            } elseif ($summaryGrade && $summaryGrade->average_score >= 4.0) {
                $categories['improvement'][] = $data;
            } else {
                $categories['first_time'][] = $data;
            }
        }


        return response()->json([
            'categories' => $categories,
            'current_schedules' => $this->getCurrentSchedules($user)
        ]);
    }

    private function getCurrentSchedules($user)
    {
        return \App\Models\Schedule::with(['courseModule.subject'])
            ->whereIn('course_module_id', function($query) use ($user) {
                $query->select('course_module_id')
                    ->from('course_registrations')
                    ->where('student_id', $user->id);
            })
            // Chỉ lấy các môn chưa hoàn thành (chưa chốt điểm)
            ->whereNotExists(function ($query) use ($user) {
                $query->select(DB::raw(1))
                    ->from('grade_course_modules')
                    ->whereColumn('grade_course_modules.course_module_id', 'schedules.course_module_id')
                    ->where('grade_course_modules.student_id', $user->student->id ?? 0)
                    ->where('is_finalized', 1);
            })
            ->get()
            ->map(function($s) {
                return [
                    'subject_name' => $s->courseModule->subject->subject_name,
                    'monday' => $s->monday,
                    'tuesday' => $s->tuesday,
                    'wednesday' => $s->wednesday,
                    'thursday' => $s->thursday,
                    'friday' => $s->friday,
                    'saturday' => $s->saturday,
                ];
            });
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

            // 2. Kiểm tra xem có đang học môn này (chưa chốt điểm) ở lớp khác không
            $subjectId = $course->subject_id;
            $isOngoing = CourseRegistration::where('student_id', $user->id)
                ->whereHas('courseModule', function($q) use ($subjectId) {
                    $q->where('subject_id', $subjectId);
                })
                ->whereNotExists(function ($query) use ($user) {
                    $query->select(DB::raw(1))
                        ->from('grade_course_modules')
                        ->whereColumn('grade_course_modules.course_module_id', 'course_registrations.course_module_id')
                        ->where('grade_course_modules.student_id', $user->student->id ?? 0)
                        ->where('is_finalized', 1);
                })
                ->exists();

            if ($isOngoing) {
                return response()->json(['message' => 'Bạn đang có một lớp học phần của môn này chưa hoàn thành điểm. Không thể đăng ký thêm.'], 422);
            }

            // 3. Kiểm tra sĩ số
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
