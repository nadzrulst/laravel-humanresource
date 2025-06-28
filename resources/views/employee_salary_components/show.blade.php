<!-- resources/views/employee_salary_components/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary Component Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/employee.css') }}">
</head>
<body class="body index">
    @extends('bar')

    @section('page-title')
        <h1>Employee Salary Component Details</h1>
    @endsection

    @section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $employeeSalaryComponent->employee->first_name }} {{ $employeeSalaryComponent->employee->last_name }}</h5>
            <p class="card-text">Salary Component: {{ $employeeSalaryComponent->salaryComponent->name }}</p>
            <p class="card-text">Amount: {{ $employeeSalaryComponent->amount }}</p>
            <p class="card-text">Active: {{ $employeeSalaryComponent->is_active ? 'Yes' : 'No' }}</p>
            <p class="card-text">Effective Date: {{ $employeeSalaryComponent->effective_date }}</p>
        </div>
    </div>

    <a href="{{ route('employee_salary_components.edit', $employeeSalaryComponent->id) }}" class="btn btn-primary mt-3">Edit</a>
    <a href="{{ route('employee_salary_components.index') }}" class="btn btn-secondary mt-3">Back</a>
    @endsection
</body>
</html>
