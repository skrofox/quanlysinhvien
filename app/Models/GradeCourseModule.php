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
    ];

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
