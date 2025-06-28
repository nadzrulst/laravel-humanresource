<!-- resources/views/employee_salary_components/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Salary Component</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/employee.css') }}">
</head>
<body class="body index">
    @extends('bar')

    @section('page-title')
        <h1>Edit Employee Salary Component</h1>
    @endsection

    @section('content')
    <form action="{{ route('employee_salary_components.update', $employeeSalaryComponent->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee</label>
            <select class="form-select" name="employee_id" id="employee_id" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == $employeeSalaryComponent->employee_id ? 'selected' : '' }}>{{ $employee->first_name }} {{ $employee->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="salary_component_id" class="form-label">Salary Component</label>
            <select class="form-select" name="salary_component_id" id="salary_component_id" required>
                @foreach ($salaryComponents as $component)
                    <option value="{{ $component->id }}" {{ $component->id == $employeeSalaryComponent->salary_component_id ? 'selected' : '' }}>{{ $component->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ $employeeSalaryComponent->amount }}" required>
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Active</label>
            <select class="form-select" name="is_active" id="is_active" required>
                <option value="1" {{ $employeeSalaryComponent->is_active ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$employeeSalaryComponent->is_active ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="effective_date" class="form-label">Effective Date</label>
            <input type="date" class="form-control" id="effective_date" name="effective_date" value="{{ $employeeSalaryComponent->effective_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('employee_salary_components.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    @endsection
</body>
</html>
