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
    <h1>Edit Permintaan Cuti</h1>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('leave_requests.update', $leaveRequest->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="employee_id">Karyawan</label>
                            <select name="employee_id" id="employee_id" class="form-control" disabled>
                                <option value="{{ $leaveRequest->employee_id }}" selected>{{ $leaveRequest->employee->name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="leave_type_id">Tipe Cuti</label>
                            <select name="leave_type_id" id="leave_type_id" class="form-control" disabled>
                                <option value="{{ $leaveRequest->leave_type_id }}" selected>{{ $leaveRequest->leaveType->name }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" 
                                   value="{{ $leaveRequest->start_date->format('Y-m-d') }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" 
                                   value="{{ $leaveRequest->end_date->format('Y-m-d') }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="total_days">Total Hari</label>
                    <input type="number" name="total_days" id="total_days" class="form-control" 
                           value="{{ $leaveRequest->total_days }}" disabled>
                </div>

                <div class="form-group mt-3">
                    <label for="reason">Alasan</label>
                    <textarea name="reason" id="reason" class="form-control" rows="3" disabled>{{ $leaveRequest->reason }}</textarea>
                </div>

                <div class="form-group mt-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending" {{ $leaveRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $leaveRequest->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ $leaveRequest->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="form-group mt-3" id="rejection_reason_group" style="display: none;">
                    <label for="rejection_reason">Alasan Penolakan</label>
                    <textarea name="rejection_reason" id="rejection_reason" class="form-control" rows="3">{{ $leaveRequest->rejection_reason }}</textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Show/hide rejection reason based on status
    document.getElementById('status').addEventListener('change', function() {
        const rejectionGroup = document.getElementById('rejection_reason_group');
        if (this.value === 'rejected') {
            rejectionGroup.style.display = 'block';
        } else {
            rejectionGroup.style.display = 'none';
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const status = document.getElementById('status');
        if (status.value === 'rejected') {
            document.getElementById('rejection_reason_group').style.display = 'block';
        }
    });
</script>
  @endsection
</body>
</html>