<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'attendance_date', 'check_in', 'check_out', 'check_in_location', 'check_out_location', 'work_hours', 'overtime_hours', 'status', 'notes'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
