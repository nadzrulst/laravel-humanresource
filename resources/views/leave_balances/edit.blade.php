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
    <h1>Edit Leave Balance</h1>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('leave_balances.update', $leaveBalance->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="employee_id">Employee</label>
                    <select name="employee_id" id="employee_id" class="form-control" disabled>
                        <option value="{{ $leaveBalance->employee_id }}" selected>{{ $leaveBalance->employee->name }}</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="leave_type_id">Leave Type</label>
                    <select name="leave_type_id" id="leave_type_id" class="form-control" disabled>
                        <option value="{{ $leaveBalance->leave_type_id }}" selected>{{ $leaveBalance->leaveType->name }}</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" name="year" id="year" class="form-control" value="{{ $leaveBalance->year }}" disabled>
                </div>
                
                <div class="form-group">
                    <label for="total_days">Total Days</label>
                    <input type="number" name="total_days" id="total_days" class="form-control" value="{{ $leaveBalance->total_days }}" required>
                </div>
                
                <div class="form-group">
                    <label for="used_days">Used Days</label>
                    <input type="number" name="used_days" id="used_days" class="form-control" value="{{ $leaveBalance->used_days }}" required>
                </div>
                
                <div class="form-group">
                    <label for="remaining_days">Remaining Days</label>
                    <input type="number" name="remaining_days" id="remaining_days" class="form-control" value="{{ $leaveBalance->remaining_days }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('leave_balances.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
  @endsection
</body>
</html>