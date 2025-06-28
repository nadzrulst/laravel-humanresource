<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Tambahkan ini
use App\Mail\UserAccountMail; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;  // Import Facade Mail
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('users.create');
    }

    // Menyimpan user baru
    public function store(Request $request)
{
    \Log::info('Memulai proses create user', ['input' => $request->all()]);

    $validated = $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|string|in:admin,user'
    ]);

    try {
        DB::beginTransaction();

        $user = User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        Mail::to($validated['email'])->send(new UserAccountMail(
            $validated['email'],
            $validated['password']
        ));

        DB::commit();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dibuat dan email terkirim');

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Error create user', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return back()
            ->withInput()
            ->with('error', 'Gagal membuat user: '.$e->getMessage());
    }
}
            // Optional: Tambahkan notifikasi ke admin jika email gagal dikirim
            // Mail::to(env('ADMIN_EMAIL'))->send(new AdminNotification('Gagal mengirim email ke user'));
        

        
    

    // Menampilkan detail user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Menampilkan form untuk mengedit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Memperbarui data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|string',
        ]);

        $user->update([
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
            'role' => $validated['role'],
        ]);

        return redirect()->route('users.index');
    }

    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index');
    }
}
