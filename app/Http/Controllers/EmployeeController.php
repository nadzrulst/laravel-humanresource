<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Mail;  // Add this line
use App\Mail\UserAccountMail; 

class EmployeeController extends Controller
{
    // Menampilkan daftar employee
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    // Menampilkan form untuk membuat employee baru
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    // Menyimpan employee baru
    public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,user',
        // Validasi data employee
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'phone' => 'required|string',
        'address' => 'required|string',
        'birth_date' => 'required|date',
        'gender' => 'required|in:male,female',
        'hire_date' => 'required|date',
        'department_id' => 'required|exists:departments,id',
        'position_id' => 'required|exists:positions,id',
        'basic_salary' => 'required|numeric',
        'status' => 'required|in:active,inactive',
    ]);

    DB::beginTransaction();

    try {
        // Buat user baru
        $user = User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        // Buat employee dengan user_id
        $employee = Employee::create([
            'user_id' => $user->id,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
            'hire_date' => $validated['hire_date'],
            'department_id' => $validated['department_id'],
            'position_id' => $validated['position_id'],
            'basic_salary' => $validated['basic_salary'],
            'status' => $validated['status'],
            'employee_code' => 'EMP' . str_pad(Employee::count() + 1, 4, '0', STR_PAD_LEFT),
        ]);

        // Send email notification
        Mail::to($validated['email'])->send(new UserAccountMail(
            $validated['email'],
            $validated['password']
        ));

        DB::commit();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully and email sent');

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Error creating employee', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return back()->withInput()->with('error', 'Failed to create employee: ' . $e->getMessage());
    }
}

    // Menampilkan detail employee
    public function show($id)
    {
        $employee = Employee::with(['department', 'position'])->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    // Menampilkan form untuk mengedit employee
    public function edit($id)
{
    $employee = Employee::findOrFail($id);
    $departments = Department::all(); // Corrected variable name (was 'departments')
    $positions = Position::all();
    return view('employees.edit', compact('employee', 'departments', 'positions'));
}

    // Memperbarui data employee
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'basic_salary' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index');
    }

    // Menghapus employee
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index');
    }
}
