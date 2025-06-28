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
    <div class="card">
        <div class="card-header">
            <h4>Salary Component Details</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Basic Information</h5>
                    <p><strong>Name:</strong> {{ $salaryComponent->name }}</p>
                    <p><strong>Code:</strong> {{ $salaryComponent->code }}</p>
                    <p><strong>Type:</strong> {{ ucfirst($salaryComponent->type) }}</p>
                    <p><strong>Default Amount:</strong> 
                        {{ number_format($salaryComponent->default_amount, 2) }}
                        {{ $salaryComponent->is_percentage ? '%' : '' }}
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Additional Information</h5>
                    <p>
                        <strong>Taxable:</strong> 
                        <span class="badge bg-{{ $salaryComponent->is_taxable ? 'danger' : 'success' }}">
                            {{ $salaryComponent->is_taxable ? 'Yes' : 'No' }}
                        </span>
                    </p>
                    <p>
                        <strong>Status:</strong> 
                        <span class="badge bg-{{ $salaryComponent->is_active ? 'success' : 'secondary' }}">
                            {{ $salaryComponent->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                    <p><strong>Created At:</strong> {{ $salaryComponent->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Updated At:</strong> {{ $salaryComponent->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <div class="mb-3">
                <h5>Description</h5>
                <p>{{ $salaryComponent->description ?? 'No description provided.' }}</p>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('salary_components.index') }}" class="btn btn-secondary">Back to List</a>
                <div>
                    <a href="{{ route('salary_components.edit', $salaryComponent->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('salary_components.destroy', $salaryComponent->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  @endsection
</body>
</html>