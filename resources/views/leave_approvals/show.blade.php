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
    <h1>Approval Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Approval #{{ $leaveApproval->id }}</h5>
            <p class="card-text">
                <strong>Leave Request:</strong> #{{ $leaveApproval->leave_request_id }}<br>
                <strong>Approver:</strong> {{ $leaveApproval->user->name }}<br>
                <strong>Status:</strong> 
                <span class="badge bg-{{ 
                    $leaveApproval->status == 'approved' ? 'success' : 
                    ($leaveApproval->status == 'rejected' ? 'danger' : 'warning') 
                }}">
                    {{ ucfirst($leaveApproval->status) }}
                </span><br>
                <strong>Comments:</strong> {{ $leaveApproval->comments ?? 'None' }}
            </p>
            <a href="{{ route('leave_approvals.edit', $leaveApproval->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('leave_approvals.destroy', $leaveApproval->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    <a href="{{ route('leave_approvals.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
  @endsection
</body>
</html>