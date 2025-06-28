<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="body index">
    @extends('das')
    @section('page-title')
    <h1 style="margin-left: 20px; font-weight: bold;">Employee</h1>  <!-- Dynamic title for the Employee page -->
    @endsection

    @section('content')
    <div class="content-header">
        <div class="filter-section">
            <input type="date" class="date-input" value="2025-03-24">
            <input type="date" class="date-input" value="2025-06-24">
            <select class="filter-dropdown">
                <option>All Transaction Type</option>
                <option>Deposit</option>
                <option>Withdrawal</option>
                <option>Earning</option>
            </select>
            <a href="{{ Route('employees.create') }}" class="btn-add-employee">
                <button class="btn-add-employee">
                    <i class="bi bi-person-plus"></i> Tambah Karyawan
                </button>
            </a>
        </div>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Hire Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->department->name }}</td>  <!-- Assuming 'name' is the department column -->
                        <td>{{ $employee->position->name }}</td>    <!-- Assuming 'name' is the position column -->
                        <td>{{ \Carbon\Carbon::parse($employee->hire_date)->format('d F Y') }}</td>
                        <td class="actions">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
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
