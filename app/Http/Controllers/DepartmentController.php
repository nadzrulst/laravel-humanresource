<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Menampilkan daftar departemen
    public function index()
    {
        $departments = Department::paginate(10);  // Tidak ada manager terkait lagi
        return view('departments.index', compact('departments'));
    }

    // Menampilkan form untuk membuat departemen baru
    public function create()
    {
        return view('departments.create');
    }

    // Menyimpan departemen baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:departments,code',
            'description' => 'required|string',
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }

    // Menampilkan detail departemen
    public function show($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.show', compact('department'));
    }

    // Menampilkan form untuk mengedit departemen
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    // Memperbarui data departemen
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:departments,code,' . $department->id,
            'description' => 'required|string',
        ]);

        $department->update($validated);

        return redirect()->route('departments.index');
    }

    // Menghapus departemen
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index');
    }
}
