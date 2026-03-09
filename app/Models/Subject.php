<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $fillable = [
        "subject_code",
        "subject_name",
        "number_of_credits",
        "department_id",
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courseModules()
    {
        return $this->hasMany(CourseModule::class);
    }
}
