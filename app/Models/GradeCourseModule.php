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
