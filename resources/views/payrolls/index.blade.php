<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payrolls List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="body index">
    @extends('das') <!-- Menggunakan layout 'das' untuk template utama -->
    
    @section('page-title')
    <h1 class="content-title">Payrolls List</h1>  <!-- Dynamic title for the Employee page -->
    @endsection

    @section('content')
    <div class="content-header">
        <a href="{{ route('payrolls.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Create New Payroll
        </a>
    </div>

    <div class="table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Net Salary</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payrolls as $payroll)
                <tr>
                    <td>{{ $payroll->id }}</td>
                    <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
                    <td>{{ $payroll->month }}</td>
                    <td>{{ $payroll->year }}</td>
                    <td>{{ number_format($payroll->net_salary, 2) }}</td> <!-- Format gaji -->
                    <td>{{ $payroll->status }}</td>
                    <td>
                        <a href="{{ route('payrolls.show', $payroll->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
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
