<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    protected $table = "course_modules";
    protected $fillable = [
        "subject_id",
        "semester_id",
        "lecturer_id",
        "number_of_students",
        "is_completed",
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, "lecturer_id");
    }

    public function courseRegistrations()
    {
        return $this->hasMany(CourseRegistration::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'grades')
                    ->withPivot('total_score');
    }
    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
}
