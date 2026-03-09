<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department_code',
        'department_name'
    ];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function getFullNameAttribute()
    {
        return $this->department_code . ' - ' . $this->department_name;
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
