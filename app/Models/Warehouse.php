<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_am',
        'code',
        'location',
        'manager_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    public function issuances()
    {
        return $this->hasMany(Issuance::class);
    }

    public function getNameAttribute($value)
    {
        $locale = app()->getLocale();
        return $locale === 'am' && $this->name_am ? $this->name_am : $value;
    }
}
