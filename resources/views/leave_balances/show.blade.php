<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/employee.css') }}">
</head>
<body class="body index">
    @extends('bar')
    @section('page-title')
    <h1 style="align-self: flex-start;">Employee</h1>  <!-- Dynamic title for the Employee page -->
@endsection
    @section('content')
    <div class="container">
    <h1>Leave Balance Details</h1>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Employee:</strong> {{ $leaveBalance->employee->name }}</p>
                    <p><strong>Leave Type:</strong> {{ $leaveBalance->leaveType->name }}</p>
                    <p><strong>Year:</strong> {{ $leaveBalance->year }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total Days:</strong> {{ $leaveBalance->total_days }}</p>
                    <p><strong>Used Days:</strong> {{ $leaveBalance->used_days }}</p>
                    <p><strong>Remaining Days:</strong> {{ $leaveBalance->remaining_days }}</p>
                </div>
            </div>
            
            <div class="mt-3">
                <a href="{{ route('leave_balances.edit', $leaveBalance->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('leave_balances.destroy', $leaveBalance->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                <a href="{{ route('leave_balances.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
  @endsection
</body>
</html>