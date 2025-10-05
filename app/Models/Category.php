<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_am',
        'code',
        'description',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function getNameAttribute($value)
    {
        $locale = app()->getLocale();
        return $locale === 'am' && $this->name_am ? $this->name_am : $value;
    }
}
