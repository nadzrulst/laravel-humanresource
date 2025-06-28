<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dahsboard.css') }}">
</head>
<body class="body index">
    @extends('das') <!-- Menggunakan layout bar untuk template utama -->
    
    @section('page-title')
    <h1 class="content-title">Daftar Tipe Cuti</h1>  <!-- Dynamic title for the Employee page -->
    @endsection
    
    @section('content')
    <div class="content-header">
        <!-- Notifikasi jika ada pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="filter-section">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLeaveTypeModal">
                <i class="fas fa-plus"></i> Tambah Tipe Cuti
            </button>
        </div>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Maks Hari/Tahun</th>
                    <th>Berbayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaveTypes as $type)
                    <tr>
                        <td>{{ $type->code }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->max_days_per_year }}</td>
                        <td>{{ $type->is_paid ? 'Ya' : 'Tidak' }}</td>
                        <td>
                            <span class="badge bg-{{ $type->is_active ? 'success' : 'danger' }}">
                                {{ $type->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('leave_types.show', $type->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('leave_types.edit', $type->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('leave_types.destroy', $type->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus tipe cuti ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data tipe cuti</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Tipe Cuti -->
    <div class="modal fade" id="addLeaveTypeModal" tabindex="-1" aria-labelledby="addLeaveTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLeaveTypeModalLabel">Tambah Tipe Cuti Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('leave_types.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Tipe Cuti</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="max_days_per_year" class="form-label">Maksimal Hari per Tahun</label>
                            <input type="number" class="form-control" id="max_days_per_year" name="max_days_per_year" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Berbayar</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_paid" id="paid_yes" value="1" checked>
                                <label class="form-check-label" for="paid_yes">Ya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_paid" id="paid_no" value="0">
                                <label class="form-check-label" for="paid_no">Tidak</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="status_active" value="1" checked>
                                <label class="form-check-label" for="status_active">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="status_inactive" value="0">
                                <label class="form-check-label" for="status_inactive">Nonaktif</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-custom"> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
</body>
</html>