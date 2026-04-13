<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan form login (SATU HALAMAN)
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        if (! Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'login' => 'Email atau password yang Anda masukkan salah.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        //  REDIRECT BERDASARKAN ROLE
        return redirect()->to($this->redirectByRole($user));
    }

    /**
     * Tentukan redirect sesuai role
     */
    protected function redirectByRole($user): string
    {
        return match ($user->role) {
            'admin'   => route('admin.dashboard'),
            'pembimbing'  => route('pembimbing.dashboard'),
            default   => route('user.dashboard'),
        };
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
