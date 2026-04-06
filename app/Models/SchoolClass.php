<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    //
    protected $fillable = [
        'class_code',
        'class_name',
        'department_id',
        'academic_batch_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function academicBatch()
    {
        return $this->belongsTo(AcademicBatch::class, 'academic_batch_id');
    }
}
