<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'email', 'password', 'role', 'email_verified_at', 'remember_token'
    ];

    // Menambahkan fungsi untuk memeriksa apakah pengguna adalah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
