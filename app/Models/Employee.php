<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'emp_list';

    protected $fillable = [
        'emp_id',
        'name',
        'name_am',
        'department',
        'position',
        'phone',
        'email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function issuances()
    {
        return $this->hasMany(Issuance::class, 'employee_id');
    }

    public function reassignmentsFrom()
    {
        return $this->hasMany(Reassignment::class, 'from_employee_id');
    }

    public function reassignmentsTo()
    {
        return $this->hasMany(Reassignment::class, 'to_employee_id');
    }

    public function getNameAttribute($value)
    {
        $locale = app()->getLocale();
        return $locale === 'am' && $this->name_am ? $this->name_am : $value;
    }
}
