<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Grade extends Model
{
    use LogsActivity;
    protected $fillable = [
        "student_id", 
        "course_module_id", 
        "academic_batch_id",
        "attendance_score", 
        "L1", 
        "L2", 
        "L3", 
        "L4", 
        "average_score", 
        "status"
    ];

    protected static function booted()
    {
        static::saving(function ($grade) {
            // Logic tính average_score có thể dựa trên điểm L1, L2...
            // Ở đây ta có thể lấy điểm cao nhất hoặc điểm lần gần nhất
            $scores = array_filter([$grade->L1, $grade->L2, $grade->L3, $grade->L4], fn($v) => is_numeric($v));
            if (!empty($scores)) {
                $grade->average_score = end($scores); // Lấy điểm của lần học cuối cùng
            }
            
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
    public function academicBatch()
    {
        return $this->belongsTo(AcademicBatch::class);
    }
    public function detailedGrades()
    {
        return $this->hasMany(GradeCourseModule::class, 'student_id', 'student_id');
    }

}
