<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Menampilkan daftar absensi
    public function index()
    {
        $attendances = Attendance::all();
        return view('attendances.index', compact('attendances'));
    }

    // Menampilkan form untuk membuat absensi baru
    public function create()
    {
        $employees = Employee::all();
        return view('attendances.create', compact('employees'));
    }

    // Menyimpan absensi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|date',
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'required|date_format:H:i',
            'check_in_location' => 'required|string',
            'check_out_location' => 'required|string',
            'work_hours' => 'required|numeric',
            'overtime_hours' => 'required|numeric',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        Attendance::create($validated);

        return redirect()->route('attendances.index');
    }

    // Menampilkan detail absensi
    public function show($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('attendances.show', compact('attendance'));
    }

    // Menampilkan form untuk mengedit absensi
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    // Memperbarui data absensi
    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $validated = $request->validate([
            'check_in' => 'sometimes|date_format:H:i',
            'check_out' => 'sometimes|date_format:H:i',
            'status' => 'sometimes|string',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendances.index');
    }

    // Menghapus absensi
    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendances.index');
    }
}

