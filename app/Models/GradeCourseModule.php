<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeCourseModule extends Model
{
    protected $fillable = [
        'student_id',
        'course_module_id',
        'semester_id',
        'DCC',
        'DGK',
        'DCK',
        'is_finalized',
    ];

    protected static function booted()
    {
        static::saving(function ($model) {
            if (!is_null($model->DCC) && !is_null($model->DGK) && !is_null($model->DCK)) {
                $model->is_finalized = 1;
            } else {
                $model->is_finalized = 0;
            }
        });

        static::saved(function ($model) {
            if ($model->is_finalized) {
                $average = ($model->DCC + $model->DGK + ($model->DCK * 2)) / 4;
                
                // Update or create summary grade
                // We'll update attendance_score and set L1 to the calculated average
                $grade = \App\Models\Grade::where('student_id', $model->student_id)
                    ->where('course_module_id', $model->course_module_id)
                    ->first();

                if ($grade) {
                    $grade->update([
                        'attendance_score' => $model->DCC,
                        'L1' => $average
                    ]);
                } else {
                    \App\Models\Grade::create([
                        'student_id' => $model->student_id,
                        'course_module_id' => $model->course_module_id,
                        'attendance_score' => $model->DCC,
                        'L1' => $average,
                        'status' => $average >= 4 ? 'pass' : 'fail'
                    ]);
                }
            }
        });
    }



    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function courseModule()
    {
        return $this->belongsTo(CourseModule::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Accessors for easier use if needed
    public function getAttendanceScoreAttribute()
    {
        return $this->DCC;
    }

    public function getMidtermScoreAttribute()
    {
        return $this->DGK;
    }

    public function getFinalScoreAttribute()
    {
        return $this->DCK;
    }
}
