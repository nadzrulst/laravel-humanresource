<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Balances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="body index">
    @extends('das')  <!-- Menggunakan layout 'das' untuk template utama -->
    
    @section('page-title')
    <h1 class="content-title">Leave Balances</h1>
    @endsection

    @section('content')
    <div class="content-header">
        <!-- Tombol untuk membuka modal form -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLeaveBalanceModal">
            <i class="fas fa-plus"></i> Add New Leave Balance
        </button>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Leave Type</th>
                    <th>Year</th>
                    <th>Total Days</th>
                    <th>Used Days</th>
                    <th>Remaining Days</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveBalances as $balance)
                <tr>
                   <td>{{ $balance->employee ? $balance->employee->name : 'Tidak Diketahui' }}</td>
                    <td>{{ $balance->leavetype ? $balance->leavetype->name : 'Tidak Diketahui' }}</td>
                    <td>{{ $balance->year }}</td>
                    <td>{{ $balance->total_days }}</td>
                    <td>{{ $balance->used_days }}</td>
                    <td>{{ $balance->remaining_days }}</td>
                    <td>
                        <a href="{{ route('leave_balances.show', $balance->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('leave_balances.edit', $balance->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('leave_balances.destroy', $balance->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Add New Leave Balance -->
    <div class="modal fade" id="addLeaveBalanceModal" tabindex="-1" aria-labelledby="addLeaveBalanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLeaveBalanceModalLabel">Create New Leave Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('leave_balances.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee</label>
                            <select class="form-select" id="employee_id" name="employee_id" required>
                                <option value="" selected disabled>Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="leave_type_id" class="form-label">Leave Type</label>
                            <select class="form-select" id="leave_type_id" name="leave_type_id" required>
                                <option value="" selected disabled>Select Leave Type</option>
                                @foreach($leaveTypes as $leaveType)
                                    <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" id="year" name="year" min="2000" max="{{ date('Y') + 1 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_days" class="form-label">Total Days</label>
                            <input type="number" step="0.1" class="form-control" id="total_days" name="total_days" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="used_days" class="form-label">Used Days</label>
                            <input type="number" step="0.1" class="form-control" id="used_days" name="used_days" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="remaining_days" class="form-label">Remaining Days</label>
                            <input type="number" step="0.1" class="form-control" id="remaining_days" name="remaining_days" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-custom">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalDaysInput = document.getElementById('total_days');
            const usedDaysInput = document.getElementById('used_days');
            const remainingDaysInput = document.getElementById('remaining_days');
            
            function calculateRemainingDays() {
                const totalDays = parseFloat(totalDaysInput.value) || 0;
                const usedDays = parseFloat(usedDaysInput.value) || 0;
                remainingDaysInput.value = (totalDays - usedDays).toFixed(1);
            }
            
            totalDaysInput.addEventListener('input', calculateRemainingDays);
            usedDaysInput.addEventListener('input', calculateRemainingDays);
        });
    </script>

    @endsection
</body>
</html>
