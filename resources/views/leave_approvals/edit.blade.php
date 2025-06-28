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
    <h1>Edit Leave Request Approval</h1>
    <form action="{{ route('leave_approvals.update', $leaveApproval->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending" {{ $leaveApproval->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $leaveApproval->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $leaveApproval->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="comments" class="form-label">Comments</label>
            <textarea class="form-control" id="comments" name="comments" rows="3">{{ $leaveApproval->comments }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('leave_approvals.show', $leaveApproval->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
  @endsection
</body>
</html>