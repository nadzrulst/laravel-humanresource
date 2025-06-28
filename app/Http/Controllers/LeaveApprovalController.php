<?php

namespace App\Http\Controllers;

use App\Models\LeaveApproval;
use Illuminate\Http\Request;

class LeaveApprovalController extends Controller
{
    public function index()
    {
        // Tambahkan eager loading untuk relasi (jika ada)
        $leaveApprovals = LeaveApproval::with(['leaveRequest', 'user'])->get();
    return view('leave_approvals.index', compact('leaveApprovals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_request_id' => 'required|exists:leave_requests,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string|in:approved,rejected,pending',
            'comments' => 'nullable|string',
        ]);

        $leaveApproval = LeaveApproval::create($validated);
        return response()->json($leaveApproval, 201); // 201: Created
    }

    public function show($id)
    {
       $leaveApprovals = LeaveApproval::with(['leaveRequest', 'user'])->get();
    return view('leave_approvals.show', compact('leaveApprovals'));
    }

    public function update(Request $request, $id)
    {
        $leaveApproval = LeaveApproval::findOrFail($id);
        $validated = $request->validate([
            'status' => 'sometimes|string|in:approved,rejected,pending',
            'comments' => 'nullable|string',
        ]);

        $leaveApproval->update($validated);
        return response()->json($leaveApproval);
    }

    public function destroy($id)
    {
        $leaveApproval = LeaveApproval::findOrFail($id);
        $leaveApproval->delete();
        return response()->json(null, 204); // 204: No Content
    }

    public function create ()
    {
          $leaveRequests = \App\Models\LeaveRequest::all(); // Data leave request yang tersedia
    $users = \App\Models\User::all(); // Data user (approver) yang tersedia
    
    return view('leave_approvals.create', compact('leaveRequests', 'users'));

    }

}