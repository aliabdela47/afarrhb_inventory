<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'department',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isWarehouseManager(): bool
    {
        return $this->role === 'warehouse_manager';
    }

    public function isAuditor(): bool
    {
        return $this->role === 'auditor';
    }

    public function managedWarehouses()
    {
        return $this->hasMany(Warehouse::class, 'manager_id');
    }

    public function issuances()
    {
        return $this->hasMany(Issuance::class, 'issued_by');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
