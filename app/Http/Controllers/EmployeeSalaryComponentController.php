<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSalaryComponent;
use App\Models\Employee;
use App\Models\SalaryComponent;
use Illuminate\Http\Request;

class EmployeeSalaryComponentController extends Controller
{
    // Menampilkan daftar employee salary components
    public function index()
    {
        $employeeSalaryComponents = EmployeeSalaryComponent::all();
        return view('employee_salary_components.index', compact('employeeSalaryComponents'));
    }

    // Menampilkan form untuk membuat employee salary component baru
    public function create()
    {
        $employees = Employee::all();
        $salaryComponents = SalaryComponent::all();
        return view('employee_salary_components.create', compact('employees', 'salaryComponents'));
    }

    // Menyimpan employee salary component baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary_component_id' => 'required|exists:salary_components,id',
            'amount' => 'required|numeric',
            'is_active' => 'required|boolean',
            'effective_date' => 'required|date',
        ]);

        EmployeeSalaryComponent::create($validated);

        return redirect()->route('employee_salary_components.index')->with('success', 'Employee Salary Component created successfully.');
    }

    // Menampilkan detail employee salary component
    public function show($id)
    {
        $employeeSalaryComponent = EmployeeSalaryComponent::findOrFail($id);
        return view('employee_salary_components.show', compact('employeeSalaryComponent'));
    }

    // Menampilkan form untuk mengedit employee salary component
    public function edit($id)
    {
        $employeeSalaryComponent = EmployeeSalaryComponent::findOrFail($id);
        $employees = Employee::all();
        $salaryComponents = SalaryComponent::all();
        return view('employee_salary_components.edit', compact('employeeSalaryComponent', 'employees', 'salaryComponents'));
    }

    // Memperbarui data employee salary component
    public function update(Request $request, $id)
    {
        $employeeSalaryComponent = EmployeeSalaryComponent::findOrFail($id);

        $validated = $request->validate([
            'amount' => 'sometimes|numeric',
            'is_active' => 'sometimes|boolean',
            'effective_date' => 'sometimes|date',
        ]);

        $employeeSalaryComponent->update($validated);

        return redirect()->route('employee_salary_components.index');
    }

    // Menghapus employee salary component
    public function destroy($id)
    {
        $employeeSalaryComponent = EmployeeSalaryComponent::findOrFail($id);
        $employeeSalaryComponent->delete();

        return redirect()->route('employee_salary_components.index');
    }
}
