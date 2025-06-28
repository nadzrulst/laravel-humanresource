<?php

namespace App\Http\Controllers;

use App\Models\PayrollComponent;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollComponentController extends Controller
{
    // Menampilkan daftar payroll components
    public function index()
    {
        $payrollComponents = PayrollComponent::all();
        return view('payroll_component.index', compact('payrollComponents'));
    }

    // Menampilkan form untuk membuat payroll component baru
    public function create()
    {
        $payrolls = Payroll::all();
        return view('payroll_component.create', compact('payrolls'));
    }

    // Menyimpan payroll component baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payroll_id' => 'required|exists:payrolls,id',
            'component_name' => 'required|string',
            'amount' => 'required|numeric',
            'is_taxable' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        PayrollComponent::create($validated);

        return redirect()->route('payroll_component.index');
    }

    // Menampilkan detail payroll component
    public function show($id)
    {
        $payrollComponent = PayrollComponent::findOrFail($id);
        return view('payroll_component.show', compact('payrollComponent'));
    }

    // Menampilkan form untuk mengedit payroll component
    public function edit($id)
    {
        $payrollComponent = PayrollComponent::findOrFail($id);
        $payrolls = Payroll::all();
        return view('payroll_component.edit', compact('payrollComponent', 'payrolls'));
    }

    // Memperbarui data payroll component
    public function update(Request $request, $id)
    {
        $payrollComponent = PayrollComponent::findOrFail($id);

        $validated = $request->validate([
            'component_name' => 'sometimes|string',
            'amount' => 'sometimes|numeric',
            'description' => 'nullable|string',
        ]);

        $payrollComponent->update($validated);

        return redirect()->route('payroll_component.index');
    }

    // Menghapus payroll component
    public function destroy($id)
    {
        $payrollComponent = PayrollComponent::findOrFail($id);
        $payrollComponent->delete();

        return redirect()->route('payroll_component.index');
    }
}
