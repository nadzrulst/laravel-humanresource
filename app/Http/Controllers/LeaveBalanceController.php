<?php

namespace App\Http\Controllers;

use App\Models\LeaveBalance;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveBalanceController extends Controller
{
    public function index()
    {
        $leaveBalances = LeaveBalance::with(['employee', 'leaveType'])->latest()->get();
        $employees = Employee::active()->get();
        $leaveTypes = LeaveType::active()->get();
        
        return view('leave_balances.index', compact('leaveBalances', 'employees', 'leaveTypes'));
    }

    public function create()
    {
        $employees = Employee::active()->get();
        $leaveTypes = LeaveType::active()->get();
        return view('leave_balances.create', compact('employees', 'leaveTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'total_days' => 'required|numeric|min:0',
            'used_days' => 'required|numeric|min:0|lte:total_days',
        ]);

        $validated['remaining_days'] = $validated['total_days'] - $validated['used_days'];

        LeaveBalance::create($validated);

        return redirect()->route('leave_balances.index')
                        ->with('success', 'Leave balance created successfully');
    }

    public function show($id)
    {
        $leaveBalance = LeaveBalance::with(['employee', 'leaveType'])->findOrFail($id);
        return view('leave_balances.show', compact('leaveBalance'));
    }

    public function edit($id)
    {
        $leaveBalance = LeaveBalance::findOrFail($id);
        return view('leave_balances.edit', compact('leaveBalance'));
    }

    public function update(Request $request, $id)
    {
        $leaveBalance = LeaveBalance::findOrFail($id);

        $validated = $request->validate([
            'total_days' => 'required|numeric|min:0',
            'used_days' => 'required|numeric|min:0|lte:total_days',
        ]);

        $validated['remaining_days'] = $validated['total_days'] - $validated['used_days'];

        $leaveBalance->update($validated);

        return redirect()->route('leave_balances.index')
                        ->with('success', 'Leave balance updated successfully');
    }

    public function destroy($id)
    {
        $leaveBalance = LeaveBalance::findOrFail($id);
        $leaveBalance->delete();

        return redirect()->route('leave_balances.index')
                        ->with('success', 'Leave balance deleted successfully');
    }
}