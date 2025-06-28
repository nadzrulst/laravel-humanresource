<!-- resources/views/employee_salary_components/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary Components List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="body index">
    @extends('das')  <!-- Menggunakan layout 'bar' untuk template utama -->
    
    @section('page-title')
        <h1 class="content-title">Employee Salary Components List</h1>
    @endsection

    @section('content')
    <div class="content-header">
        <a href="{{ route('employee_salary_components.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Create New Employee Salary Component
        </a>
    </div>

    <div class="table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Salary Component</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeSalaryComponents as $employeeSalaryComponent)
                <tr>
                    <td>{{ $employeeSalaryComponent->id }}</td>
                    <td>{{ $employeeSalaryComponent->employee->first_name }} {{ $employeeSalaryComponent->employee->last_name }}</td>
                    <td>{{ $employeeSalaryComponent->salaryComponent->name }}</td>
                    <td>{{ $employeeSalaryComponent->amount }}</td>
                    <td>
                        <a href="{{ route('employee_salary_components.show', $employeeSalaryComponent->id) }}">View</a> |
                        <a href="{{ route('employee_salary_components.edit', $employeeSalaryComponent->id) }}">Edit</a> |
                        <form action="{{ route('employee_salary_components.destroy', $employeeSalaryComponent->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</body>
</html>
