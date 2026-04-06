<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Grade extends Model
{
    use LogsActivity;
    protected $fillable = ["student_id", "course_module_id", "attendance_score", "midterm_score", "final_score", "average_score", "status"];

    protected static function booted()
    {
        static::saving(function ($grade) {
            $attendance = (float) $grade->attendance_score;
            $midterm = (float) $grade->midterm_score;
            $final = (float) $grade->final_score;
            
            // Tính trung bình cộng (có thể thay đổi tỉ lệ tùy trường, VD: chuyên cần 10%, giữa kì 30%, cuối kì 60%)
            $grade->average_score = round(($attendance + $midterm + $final) / 3, 2);
            $grade->status = $grade->average_score >= 5 ? 'pass' : 'fail';

            // Kiểm tra đăng ký môn học
            $student = \App\Models\Student::find($grade->student_id);
            if (!$student) return;

            $isRegistered = \App\Models\CourseRegistration::where('student_id', $student->user_id)
                ->where('course_module_id', $grade->course_module_id)
                ->exists();

            if (!$isRegistered) {
                throw new \Exception('Sinh viên này chưa đăng ký lớp học phần này.');
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function courseModule()
    {
        return $this->belongsTo(CourseModule::class);
    }
}
