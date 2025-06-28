<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan Anda memiliki view 'login'
    }

    // Proses login (web login menggunakan session)
    public function loginWeb(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah email dan password cocok
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek apakah user bukan admin
            if ($user->role !== 'admin') {
                Auth::logout(); // paksa logout
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Only admins are allowed to login via web.',
                ]);
            }

            // Jika admin, lanjutkan
            return response()->json([
                'message' => 'Login berhasil',
                'employee_id' => $user->employee_id,
                'user' => $user,
                'role' => $user->role,
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Proses logout untuk web
    public function logoutWeb(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    // Register a new user (API)
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user'
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    // User login via API (for token generation)
    public function login(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists and if the password matches
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Check if the user's role is 'blocked'
        if ($user->role == 'blocked') {
            return response()->json([
                'message' => 'Your account is not allowed to log in at this time.',
            ], 403); // 403 Forbidden
        }

        // Generate a token for the authenticated user
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
            'role' => $user->role, // Include the role in the response
        ]);
    }

    // API logout (delete token)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    // Verify if the token is valid (for mobile app token check)
    public function verifyToken(Request $request)
    {
        return response()->json(['valid' => true]);
    }

    // Get the authenticated user's data
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
