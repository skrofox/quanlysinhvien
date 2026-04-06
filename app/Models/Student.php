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
        'school_class_id',
        'user_id',
        'CCCD'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function grades(){
        return $this->hasMany(Grade::class);
    }
    public function courseRegistrations()
    {
        return $this->hasMany(CourseRegistration::class, 'student_id', 'user_id');
    }
    public function courseModule()
    {
        return $this->belongsToMany(CourseModule::class,'grades')
            ->withPivot('midterm_score','final_score', 'total_score');
    }
}
