<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    protected $fillable = [
        'student_id',
        'course_module_id',
        'registration_date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function courseModule()
    {
        return $this->belongsTo(CourseModule::class);
    }
}
