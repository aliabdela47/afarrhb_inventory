<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuanceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'issuance_id',
        'item_id',
        'quantity_requested',
        'quantity_issued',
        'unit_price',
        'remarks',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
    ];

    public function issuance()
    {
        return $this->belongsTo(Issuance::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getTotalPrice()
    {
        return $this->quantity_issued * $this->unit_price;
    }
}
