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
            <h4>Edit Salary Component</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('salary_components.update', $salaryComponent->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Component Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $salaryComponent->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="code" class="form-label">Component Code</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $salaryComponent->code }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="fixed" {{ $salaryComponent->type === 'fixed' ? 'selected' : '' }}>Fixed</option>
                            <option value="variable" {{ $salaryComponent->type === 'variable' ? 'selected' : '' }}>Variable</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="default_amount" class="form-label">Default Amount</label>
                        <input type="number" step="0.01" class="form-control" id="default_amount" name="default_amount" value="{{ $salaryComponent->default_amount }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_percentage" name="is_percentage" value="1" {{ $salaryComponent->is_percentage ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_percentage">Is Percentage</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_taxable" name="is_taxable" value="1" {{ $salaryComponent->is_taxable ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_taxable">Is Taxable</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ $salaryComponent->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Is Active</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $salaryComponent->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Component</button>
                <a href="{{ route('salary_components.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
  @endsection
</body>
</html>