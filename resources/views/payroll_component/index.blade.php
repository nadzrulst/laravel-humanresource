<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Components List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="body index">
    @extends('das')  <!-- Menggunakan layout 'das' untuk template utama -->
    
    @section('page-title')
    <h1 class="content-title">Payroll Components</h1>  <!-- Judul halaman Payroll Components -->
    @endsection

    @section('content')
    <div class="content-header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Payroll Components</h1>
            <a href="{{ route('payroll_component.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add Component
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Payroll ID</th>
                    <th>Component Name</th>
                    <th>Amount</th>
                    <th>Taxable</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payrollComponents as $component)
                    <tr>
                        <td>{{ $component->id }}</td>
                        <td>{{ $component->payroll_id }}</td>
                        <td>{{ $component->component_name }}</td>
                        <td>{{ number_format($component->amount, 2) }}</td>
                        <td>
                            @if($component->is_taxable)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('payroll_component.show', $component->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('payroll_component.edit', $component->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('payroll_component.destroy', $component->id) }}" method="POST" style="display: inline-block;">
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
