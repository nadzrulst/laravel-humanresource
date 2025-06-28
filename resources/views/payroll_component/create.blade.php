@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Add New Payroll Component</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('payroll_component.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="payroll_id" class="form-label">Payroll</label>
                            <select class="form-select @error('payroll_id') is-invalid @enderror" id="payroll_id" name="payroll_id" required>
                                <option value="">Select Payroll</option>
                                @foreach($payrolls as $payroll)
                                <option value="{{ $payroll->id }}" {{ old('payroll_id') == $payroll->id ? 'selected' : '' }}>
                                    {{ $payroll->employee->name }} - {{ $payroll->month }}/{{ $payroll->year }}
                                </option>
                                @endforeach
                            </select>
                            @error('payroll_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="component_name" class="form-label">Component Name</label>
                            <input type="text" class="form-control @error('component_name') is-invalid @enderror" id="component_name" name="component_name" value="{{ old('component_name') }}" required>
                            @error('component_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="is_taxable" class="form-label">Is Taxable?</label>
                            <select class="form-select @error('is_taxable') is-invalid @enderror" id="is_taxable" name="is_taxable" required>
                                <option value="1" {{ old('is_taxable') == '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('is_taxable') == '0' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('is_taxable')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Component
                            </button>
                            <a href="{{ route('payroll_component_.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection