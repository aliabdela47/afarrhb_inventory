<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_am',
        'code',
        'category_id',
        'description',
        'unit_of_measure',
        'unit_price',
        'reorder_level',
        'is_active',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    public function issuanceItems()
    {
        return $this->hasMany(IssuanceItem::class);
    }

    public function getNameAttribute($value)
    {
        $locale = app()->getLocale();
        return $locale === 'am' && $this->name_am ? $this->name_am : $value;
    }

    public function getTotalQuantity()
    {
        return $this->inventory()->sum('quantity');
    }

    public function getAvailableQuantity()
    {
        return $this->inventory()->sum('available_quantity');
    }
}
