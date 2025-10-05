<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issuance extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'type',
        'warehouse_id',
        'employee_id',
        'issued_by',
        'issue_date',
        'issue_date_ethiopian',
        'status',
        'purpose',
        'remarks',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'issue_date_ethiopian' => 'date',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function items()
    {
        return $this->hasMany(IssuanceItem::class);
    }

    public function reassignments()
    {
        return $this->hasMany(Reassignment::class);
    }

    public function getTotalValue()
    {
        return $this->items()->sum(\DB::raw('quantity_issued * unit_price'));
    }
}
