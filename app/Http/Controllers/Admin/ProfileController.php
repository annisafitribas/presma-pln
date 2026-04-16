<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Tampilkan profil admin (SHOW)
     */
    public function show(Request $request)
    {
        return view('admin.profile_show', [
            'admin' => $request->user(),
        ]);
    }

    /**
     * Tampilkan form edit profil admin
     */
    public function edit(Request $request)
    {
        return view('admin.profile_edit', [
            'admin' => $request->user(),
        ]);
    }

    /**
     * Update profil admin
     */
    public function update(Request $request)
    {
        $admin = $request->user();

        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($admin->id)],
            'password'  => ['nullable', 'confirmed', 'min:6'],
            'foto'      => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'gender'    => ['nullable', Rule::in(['L', 'P'])],
            'tgl_lahir' => ['nullable', 'date', 'before_or_equal:today'],
            'no_hp'     => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'alamat'    => ['required', 'string', 'max:500'],
        ]);
        /*  FOTO  */
        /*  FOTO (COMPRESS)  */
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($admin->foto && Storage::disk('public')->exists($admin->foto)) {
                Storage::disk('public')->delete($admin->foto);
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

            $admin->foto = $path;
        }

        /*  UPDATE DATA  */
        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],

            'gender' => $validated['gender'] ?? null,
            'tgl_lahir' => $validated['tgl_lahir'] ?? null,
            'no_hp' => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,

            'password' => $request->filled('password')
                ? Hash::make($validated['password'])
                : $admin->password,

            // foto diset manual di atas
            'foto' => $admin->foto,
        ]);

        return redirect()
            ->route('admin.profile.show')
            ->with('success', 'Profil admin berhasil diperbarui');
    }
}
