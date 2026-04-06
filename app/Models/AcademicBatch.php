<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicBatch extends Model
{
    // Đổi tên bảng tương ứng trong DB
    protected $table = 'academic_batches';

    protected $fillable = ["start_year", "end_year"];

    public function schoolClasses()
    {
        return $this->hasMany(SchoolClass::class, 'academic_batch_id');
    }

    public function getRangeAttribute()
    {
        return "{$this->start_year} - {$this->end_year}";
    }
}
