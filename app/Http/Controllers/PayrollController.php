<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    // Menampilkan daftar payroll
    public function index()
    {
        // Mendapatkan daftar payrolls beserta data terkait employee
        $payrolls = Payroll::with('employee')->get();  // Memastikan relasi employee dimuat
        return view('payrolls.index', compact('payrolls'));  // Mengirim data ke view
    }

    // Menampilkan form untuk membuat payroll baru
    public function create()
    {
        $employees = Employee::all();
        return view('payrolls.create', compact('employees'));
    }

    // Menyimpan payroll baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'basic_salary' => 'required|numeric',
            'allowances' => 'nullable|numeric',
            'overtime_pay' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'net_salary' => 'required|numeric',
            'work_days' => 'required|numeric',
            'absent_days' => 'required|numeric',
            'status' => 'required|string',
        ]);

        Payroll::create($validated);

        return redirect()->route('payrolls.index');
    }

    // Menampilkan detail payroll
    public function show($id)
    {
        $payroll = Payroll::findOrFail($id);
        return view('payrolls.show', compact('payroll'));
    }

    // Menampilkan form untuk mengedit payroll
    public function edit($id)
    {
        $payroll = Payroll::findOrFail($id);
        $employees = Employee::all();
        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    // Memperbarui data payroll
    public function update(Request $request, $id)
    {
        $payroll = Payroll::findOrFail($id);

        $validated = $request->validate([
            'net_salary' => 'sometimes|numeric',
            'status' => 'sometimes|string',
            'work_days' => 'sometimes|numeric',
            'absent_days' => 'sometimes|numeric',
        ]);

        $payroll->update($validated);

        return redirect()->route('payrolls.index');
    }

    // Menghapus payroll
    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();

        return redirect()->route('payrolls.index');
    }
}


