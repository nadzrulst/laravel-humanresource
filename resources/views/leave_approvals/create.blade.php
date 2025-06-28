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
    <h1>Create Leave Request Approval</h1>
    <form action="{{ route('leave_approvals.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="leave_request_id" class="form-label">Leave Request ID</label>
            <select class="form-control" id="leave_request_id" name="leave_request_id" required>
                @foreach($leaveRequests as $request)
                <option value="{{ $request->id }}">Request #{{ $request->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Approver</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="comments" class="form-label">Comments</label>
            <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
  @endsection
</body>
</html>