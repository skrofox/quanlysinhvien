<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = ["start_year", "end_year"];

    public function schoolClasses()
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function getRangeAttribute()
    {
        return "{$this->start_year} - {$this->end_year}";
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }
}
