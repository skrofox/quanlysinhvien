<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'title',
        'file_path',
        'drive_link',
        'semester_id',
        'academic_batch_id',
        'is_active',
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function academicBatch()
    {
        return $this->belongsTo(AcademicBatch::class);
    }
}
