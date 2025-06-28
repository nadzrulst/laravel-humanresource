<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Components</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="body index">
    @extends('das')  <!-- Menggunakan layout 'das' untuk template utama -->
    
    @section('page-title')
    <h1 class="content-title">Salary Components</h1>  <!-- Judul halaman -->
    @endsection

    @section('content')
    <div class="content-header">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Salary Components</h1>
            <!-- Tombol untuk membuka modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSalaryComponentModal">
                <i class="fas fa-plus"></i> Add New Component
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Taxable</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salaryComponents as $component)
                    <tr>
                        <td>{{ $component->code }}</td>
                        <td>{{ $component->name }}</td>
                        <td>{{ ucfirst($component->type) }}</td>
                        <td>{{ number_format($component->default_amount, 2) }} {{ $component->is_percentage ? '%' : '' }}</td>
                        <td>
                            <span class="badge bg-{{ $component->is_taxable ? 'danger' : 'success' }}">
                                {{ $component->is_taxable ? 'Taxable' : 'Non-Taxable' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $component->is_active ? 'success' : 'secondary' }}">
                                {{ $component->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('salary_components.show', $component->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('salary_components.edit', $component->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('salary_components.destroy', $component->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Salary Component -->
    <div class="modal fade" id="addSalaryComponentModal" tabindex="-1" aria-labelledby="addSalaryComponentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSalaryComponentModalLabel">Tambah Salary Component Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('salary_components.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Component Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Component Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="fixed">Fixed</option>
                                <option value="variable">Variable</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="default_amount" class="form-label">Default Amount</label>
                            <input type="number" step="0.01" class="form-control" id="default_amount" name="default_amount" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_percentage" name="is_percentage" value="1">
                                <label class="form-check-label" for="is_percentage">Is Percentage</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_taxable" name="is_taxable" value="1" checked>
                                <label class="form-check-label" for="is_taxable">Is Taxable</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Is Active</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Component</button>
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
