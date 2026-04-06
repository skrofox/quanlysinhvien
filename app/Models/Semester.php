<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        "semester_name",
        "school_year_id",
    ];

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function courseModules()
    {
        return $this->hasMany(CourseModule::class);
    }
}
