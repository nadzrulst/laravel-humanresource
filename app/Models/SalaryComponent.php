<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryComponent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'type', 'default_amount', 'is_percentage', 'is_taxable', 'is_active', 'description'];

    public function payrollComponents()
    {
        return $this->hasMany(PayrollComponent::class);
    }
}
