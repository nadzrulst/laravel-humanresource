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
    @extends('das') <!-- Menggunakan layout das untuk template utama -->
    
    @section('page-title')
    <h1 class="content-title">Daftar Permintaan Cuti</h1>  <!-- Dynamic title for the Employee page -->
    @endsection
    
    @section('content')
    <div class="content-header">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="filter-section">
            <a href="{{ route('leave_requests.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Permintaan Cuti
            </a>
        </div>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Karyawan</th>
                    <th>Tipe Cuti</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Total Hari</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaveRequests as $request)
                    <tr>
                        <td>{{ $request->employee->name }}</td>
                        <td>{{ $request->leaveType->name }}</td>
                        <td>{{ $request->start_date->format('d/m/Y') }}</td>
                        <td>{{ $request->end_date->format('d/m/Y') }}</td>
                        <td>{{ $request->total_days }}</td>
                        <td>
                            <span class="badge bg-{{ $request->status == 'approved' ? 'success' : ($request->status == 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('leave_requests.show', $request->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('leave_requests.edit', $request->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('leave_requests.destroy', $request->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus permintaan cuti ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada permintaan cuti</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @endsection
</body>
</html>
