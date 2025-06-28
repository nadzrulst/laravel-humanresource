<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="body index">
    @extends('das')
    @section('page-title')
    <h1 style="margin-left: 20px; font-weight: bold; ">Employee</h1>  <!-- Dynamic title for the Employee page -->
@endsection
    @section('content')
     <div class="container">
    <h1>Leave Request Approvals</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Leave Request</th>
                <th>Approver</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaveApprovals as $approval)
            <tr>
                <td>{{ $approval->id }}</td>
                <td>Request #{{ $approval->leave_request_id }}</td>
                <td>{{ $approval->user->name }}</td>
                <td>
                    <span class="badge bg-{{ 
                        $approval->status == 'approved' ? 'success' : 
                        ($approval->status == 'rejected' ? 'danger' : 'warning') 
                    }}">
                        {{ ucfirst($approval->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('leave_approvals.show', $approval->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('leave_approvals.edit', $approval->id) }}" class="btn btn-sm btn-primary">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('leave_approvals.create') }}" class="btn btn-success">Create New Approval</a>
</div>
@endsection
</body>
</html>