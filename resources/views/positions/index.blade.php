<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Position List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="body index">
    @extends('das') <!-- Menggunakan layout 'das' untuk template utama -->
    
    @section('page-title')
    <h1 class="content-title">Position List</h1>  <!-- Judul Halaman -->
    @endsection

    @section('content')
    <div class="content-header">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Position List</h1>
            <a href="{{ route('positions.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add New Position
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($positions as $position)
                    <tr>
                        <td>{{ $position->id }}</td>
                        <td>{{ $position->code }}</td>
                        <td>{{ $position->name }}</td>
                        <td>{{ $position->department->name }}</td>
                        <td>{{ $position->description }}</td>
                        <td class="actions">
                            <a href="{{ route('positions.show', $position->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this position?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" class="text-center">No positions found.</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if($positions->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $positions->links() }} <!-- Menambahkan pagination -->
        </div>
    @endif
    @endsection
</body>
</html>
