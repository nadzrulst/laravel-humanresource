<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'description', 'min_salary', 'max_salary', 'department_id'];

    // public function department() removed to avoid redeclaration

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    // Di model Position.php
public function department()
{
    return $this->belongsTo(Department::class, 'department_id');
}

}
