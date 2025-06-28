<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    // Menampilkan daftar activity logs
    public function index()
    {
        $activityLogs = ActivityLog::all();
        return view('activity_logs.index', compact('activityLogs'));
    }

    // Menampilkan form untuk membuat activity log baru
    public function create()
    {
        $users = User::all();
        return view('activity_logs.create', compact('users'));
    }

    // Menyimpan activity log baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'activity_type' => 'required|string',
            'table_name' => 'required|string',
            'record_id' => 'required|integer',
            'old_values' => 'nullable|json',
            'new_values' => 'nullable|json',
            'ip_address' => 'required|string',
            'user_agent' => 'required|string',
        ]);

        ActivityLog::create($validated);

        return redirect()->route('activity_logs.index');
    }

    // Menampilkan detail activity log
    public function show($id)
    {
        $activityLog = ActivityLog::findOrFail($id);
        return view('activity_logs.show', compact('activityLog'));
    }

    // Menampilkan form untuk mengedit activity log
    public function edit($id)
    {
        $activityLog = ActivityLog::findOrFail($id);
        $users = User::all();
        return view('activity_logs.edit', compact('activityLog', 'users'));
    }

    // Memperbarui data activity log
    public function update(Request $request, $id)
    {
        $activityLog = ActivityLog::findOrFail($id);

        $validated = $request->validate([
            'activity_type' => 'sometimes|string',
            'old_values' => 'nullable|json',
            'new_values' => 'nullable|json',
        ]);

        $activityLog->update($validated);

        return redirect()->route('activity_logs.index');
    }

    // Menghapus activity log
    public function destroy($id)
    {
        $activityLog = ActivityLog::findOrFail($id);
        $activityLog->delete();

        return redirect()->route('activity_logs.index');
    }
}

