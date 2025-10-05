<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reassignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'issuance_id',
        'from_employee_id',
        'to_employee_id',
        'reassigned_by',
        'reassignment_date',
        'reason',
        'status',
    ];

    protected $casts = [
        'reassignment_date' => 'date',
    ];

    public function issuance()
    {
        return $this->belongsTo(Issuance::class);
    }

    public function fromEmployee()
    {
        return $this->belongsTo(Employee::class, 'from_employee_id');
    }

    public function toEmployee()
    {
        return $this->belongsTo(Employee::class, 'to_employee_id');
    }

    public function reassignedBy()
    {
        return $this->belongsTo(User::class, 'reassigned_by');
    }
}
