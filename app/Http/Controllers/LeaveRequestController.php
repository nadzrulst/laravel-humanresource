<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    // Menampilkan daftar permintaan cuti
    public function index()
    {
        $leaveRequests = LeaveRequest::all();
        return view('leave_requests.index', compact('leaveRequests'));
    }

    // Menampilkan form untuk membuat permintaan cuti baru
    public function create()
    {
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();
        return view('leave_requests.create', compact('employees', 'leaveTypes'));
    }

    // Menyimpan permintaan cuti baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'total_days' => 'required|numeric',
            'reason' => 'required|string',
            'status' => 'required|string',
        ]);

        LeaveRequest::create($validated);

        return redirect()->route('leave_requests.index');
    }

    // Menampilkan detail permintaan cuti
    public function show($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        return view('leave_requests.show', compact('leaveRequest'));
    }

    // Menampilkan form untuk mengedit permintaan cuti
    public function edit($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();
        return view('leave_requests.edit', compact('leaveRequest', 'employees', 'leaveTypes'));
    }

    // Memperbarui data permintaan cuti
    public function update(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);

        $validated = $request->validate([
            'status' => 'sometimes|string',
        ]);

        $leaveRequest->update($validated);

        return redirect()->route('leave_requests.index');
    }

    // Menghapus permintaan cuti
    public function destroy($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->delete();

        return redirect()->route('leave_requests.index');
    }
}

