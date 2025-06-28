<?php

namespace App\Http\Controllers;

use App\Models\SalaryComponent;
use Illuminate\Http\Request;

class SalaryComponentController extends Controller
{
    // Menampilkan daftar salary components
    public function index()
    {
        $salaryComponents = SalaryComponent::all();
        return view('salary_components.index', compact('salaryComponents'));
    }

    // Menampilkan form untuk membuat salary component baru
    public function create()
    {
        return view('salary_components.create');
    }

    // Menyimpan salary component baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:salary_components,code',
            'type' => 'required|string|in:fixed,variable',
            'default_amount' => 'required|numeric',
            'is_percentage' => 'required|boolean',
            'is_taxable' => 'required|boolean',
            'is_active' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        SalaryComponent::create($validated);

        return redirect()->route('salary_components.index');
    }

    // Menampilkan detail salary component
    public function show($id)
    {
        $salaryComponent = SalaryComponent::findOrFail($id);
        return view('salary_components.show', compact('salaryComponent'));
    }

    // Menampilkan form untuk mengedit salary component
    public function edit($id)
    {
        $salaryComponent = SalaryComponent::findOrFail($id);
        return view('salary_components.edit', compact('salaryComponent'));
    }

    // Memperbarui data salary component
    public function update(Request $request, $id)
    {
        $salaryComponent = SalaryComponent::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'code' => 'sometimes|string|unique:salary_components,code,' . $salaryComponent->id,
            'default_amount' => 'sometimes|numeric',
        ]);

        $salaryComponent->update($validated);

        return redirect()->route('salary_components.index');
    }

    // Menghapus salary component
    public function destroy($id)
    {
        $salaryComponent = SalaryComponent::findOrFail($id);
        $salaryComponent->delete();

        return redirect()->route('salary_components.index');
    }
}
