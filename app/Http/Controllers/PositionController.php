<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    // Menampilkan daftar posisi
    public function index()
    {
       $positions = Position::with('department')->paginate(10); // Fetch 10 positions per page
    return view('positions.index', compact('positions'));
    }

    // Menampilkan form untuk membuat posisi baru
    public function create()
    {
        $departments = Department::all();
        return view('positions.create', compact('departments'));
    }

    // Menyimpan posisi baru
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'code' => 'required|string|unique:positions,code',
        'description' => 'required|string',
        'department_id' => 'required|exists:departments,id',
        'min_salary' => 'nullable|numeric',
        'max_salary' => 'nullable|numeric|gt:min_salary',
    ]);

    Position::create($validated);

    return redirect()->route('positions.index')->with('success', 'Position created successfully');
}

    // Menampilkan detail posisi
    public function show($id)
    {
        $position = Position::with('department')->findOrFail($id);
        return view('positions.show', compact('position'));
    }

    // Menampilkan form untuk mengedit posisi
    public function edit($id)
    {
        $position = Position::findOrFail($id);
        $departments = Department::all();
        return view('positions.edit', compact('position', 'departments'));
    }

    // Memperbarui data posisi
    public function update(Request $request, $id)
    {
        $position = Position::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:positions,code,' . $position->id,
            'description' => 'required|string',
            'department_id' => 'required|exists:departments,id',
        ]);

        $position->update($validated);

        return redirect()->route('positions.index');
    }

    // Menghapus posisi
    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect()->route('positions.index');
    }

 
}
