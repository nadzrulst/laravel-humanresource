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
    <h1>Detail Permintaan Cuti</h1>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Karyawan:</strong> {{ $leaveRequest->employee->name }}</p>
                    <p><strong>Tipe Cuti:</strong> {{ $leaveRequest->leaveType->name }}</p>
                    <p><strong>Tanggal Mulai:</strong> {{ $leaveRequest->start_date->format('d/m/Y') }}</p>
                    <p><strong>Tanggal Selesai:</strong> {{ $leaveRequest->end_date->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total Hari:</strong> {{ $leaveRequest->total_days }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-@switch($leaveRequest->status)
                            @case('approved') success @break
                            @case('rejected') danger @break
                            @default warning
                        @endswitch">
                            {{ ucfirst($leaveRequest->status) }}
                        </span>
                    </p>
                    @if($leaveRequest->approved_at)
                        <p><strong>Disetujui pada:</strong> {{ $leaveRequest->approved_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <p><strong>Alasan:</strong></p>
                <p>{{ $leaveRequest->reason }}</p>
            </div>

            @if($leaveRequest->rejection_reason)
                <div class="mt-3">
                    <p><strong>Alasan Penolakan:</strong></p>
                    <p>{{ $leaveRequest->rejection_reason }}</p>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('leave_requests.edit', $leaveRequest->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
  @endsection
</body>
</html>