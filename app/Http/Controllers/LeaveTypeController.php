<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    // Menampilkan daftar tipe cuti
    public function index()
    {
        $leaveTypes = LeaveType::all();
        return view('leave_types.index', compact('leaveTypes'));
    }

    // Menampilkan form untuk membuat tipe cuti baru
    public function create()
    {
        return view('leave_types.create');
    }

    // Menyimpan tipe cuti baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:leave_types,code',
            'max_days_per_year' => 'required|numeric',
            'is_paid' => 'required|boolean',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        LeaveType::create($validated);

        return redirect()->route('leave_types.index');
    }

    // Menampilkan detail tipe cuti
    public function show($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        return view('leave_types.show', compact('leaveType'));
    }

    // Menampilkan form untuk mengedit tipe cuti
    public function edit($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        return view('leave_types.edit', compact('leaveType'));
    }

    // Memperbarui data tipe cuti
    public function update(Request $request, $id)
    {
        $leaveType = LeaveType::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'description' => 'nullable|string',
            'max_days_per_year' => 'sometimes|numeric',
            'is_paid' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
        ]);

        $leaveType->update($validated);

        return redirect()->route('leave_types.index');
    }

    // Menghapus tipe cuti
    public function destroy($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        $leaveType->delete();

        return redirect()->route('leave_types.index');
    }
}

