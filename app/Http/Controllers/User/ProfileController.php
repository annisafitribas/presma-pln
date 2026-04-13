<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil
     */
    public function index(Request $request)
    {
        $user = $request->user()->load([
            'profile.bagian',
            'profile.pembimbing.user'
        ]);

        return view('user.profile_index', compact('user'));
    }

    /**
     * Tampilkan form edit
     */
    public function edit(Request $request)
    {
        $user = $request->user()->load([
            'profile.bagian',
            'profile.pembimbing.user'
        ]);

        return view('user.profile_edit', compact('user'));
    }

    /**
     * Update profil user
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id)
            ],
            'foto'      => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'gender'    => ['required', Rule::in(['L', 'P'])],
            'tgl_lahir' => ['nullable', 'date', 'before_or_equal:today'],
            'no_hp'     => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'alamat'    => ['nullable', 'string', 'max:500'],
        ]);

        /*
        | FOTO
        */
        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            $user->foto = $request->file('foto')->store('foto_users', 'public');
        }

        /*
        | UPDATE DATA
        */
        $user->update([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'gender'    => $validated['gender'],
            'tgl_lahir' => $validated['tgl_lahir'] ?? null,
            'no_hp'     => $validated['no_hp'],
            'alamat'    => $validated['alamat'],
            'foto'      => $user->foto,
        ]);

        return redirect()
            ->route('user.profile.index')
            ->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Update password user
     */
    public function updatePassword(Request $request)
    {
        $user = $request->user();

        try {

            $validated = $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => [
                    'required',
                    'min:6',
                    'confirmed',
                    'different:current_password'
                ],
            ], [
                'current_password.required' => 'Masukkan password lama',
                'current_password.current_password' => 'Password lama salah',
                'password.required' => 'Masukkan password baru',
                'password.min' => 'Password baru minimal 6 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
                'password.different' => 'Password baru tidak boleh sama dengan password lama',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('open_password_modal', true);
        }

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }
}
