<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\PembimbingProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /*
    | INDEX
    */
    public function index(Request $request)
    {
        $user = $request->user();

        $user->load([
            'pembimbingProfile' => function ($q) {
                $q->with('bidang');
            }
        ]);

        return view('pembimbing.profile_index', compact('user'));
    }

    /*
    | EDIT
    */
    public function edit(Request $request)
    {
        $user = $request->user();

        $user->load([
            'pembimbingProfile' => function ($q) {
                $q->with('bidang');
            }
        ]);

        $bidangs = Bidang::orderBy('nama')->get();

        return view('pembimbing.profile_edit', compact('user', 'bidangs'));
    }

    /*
    | UPDATE
    */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            // DATA USER
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'foto'      => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'gender'    => ['required', Rule::in(['L', 'P'])],
            'tgl_lahir' => ['nullable', 'date', 'before_or_equal:today'],
            'no_hp'     => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'alamat'    => ['nullable', 'string', 'max:500'],

            // DATA PEMBIMBING
            'nip'       => ['nullable', 'string', 'max:50'],
            'jabatan'   => ['required', 'string', 'max:100'],
            'bidang_id' => ['required', 'exists:bidangs,id'],
        ]);

        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $file = $request->file('foto');

            $manager = new ImageManager(new Driver());

            $image = $manager->read($file)
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->toJpeg(70);

            $path = 'foto_users/' . uniqid() . '.jpg';

            Storage::disk('public')->put($path, $image);

            $user->foto = $path;
        }

        /*
        | UPDATE USER
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

        /*
        | UPDATE / CREATE PEMBIMBING PROFILE
        | Aman walau profile belum ada
        */
        PembimbingProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nip'       => $validated['nip'],
                'jabatan'   => $validated['jabatan'],
                'bidang_id' => $validated['bidang_id'],
            ]
        );

        return redirect()
            ->route('pembimbing.profile.index')
            ->with('success', 'Profil berhasil diperbarui');
    }

    /*
    | UPDATE PASSWORD
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
