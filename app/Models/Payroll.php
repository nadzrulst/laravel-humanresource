<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'month', 'year', 'basic_salary', 'allowances', 'overtime_pay', 'deductions', 'tax', 'net_salary', 'work_days', 'absent_days', 'status', 'processed_at', 'processed_by'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function payrollComponents()
    {
        return $this->hasMany(PayrollComponent::class);
    }
}

