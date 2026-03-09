<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use LogsActivity;

    protected $fillable = [
        'student_code',
        'full_name',
        'birthday',
        'gender',
        'school_class_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
