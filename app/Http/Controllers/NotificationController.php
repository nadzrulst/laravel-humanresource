<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Menampilkan daftar notifications
    public function index()
    {
        $notifications = Notification::all();
        return view('notifications.index', compact('notifications'));
    }

    // Menampilkan form untuk membuat notification baru
    public function create()
    {
        $users = User::all();
        return view('notifications.create', compact('users'));
    }

    // Menyimpan notification baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'message' => 'required|string',
            'type' => 'required|string',
            'is_read' => 'required|boolean',
            'read_at' => 'nullable|date',
        ]);

        Notification::create($validated);

        return redirect()->route('notifications.index');
    }

    // Menampilkan detail notification
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        return view('notifications.show', compact('notification'));
    }

    // Menampilkan form untuk mengedit notification
    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        $users = User::all();
        return view('notifications.edit', compact('notification', 'users'));
    }

    // Memperbarui data notification
    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string',
            'message' => 'sometimes|string',
            'type' => 'sometimes|string',
            'is_read' => 'sometimes|boolean',
            'read_at' => 'nullable|date',
        ]);

        $notification->update($validated);

        return redirect()->route('notifications.index');
    }

    // Menghapus notification
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('notifications.index');
    }
}
