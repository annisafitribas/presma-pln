<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Bagian;
use App\Models\UserProfile;
use App\Models\PembimbingProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AkunController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role', 'all');

        $query = User::with([
            'pembimbingProfile.bagian',
            'pembimbingProfile.usersDibimbing',
            'profile.bagian'
        ]);

        if ($role !== 'all') {
            $query->where('role', $role);
        }

        $users = $query->get();

        return view('admin.pengguna_index', compact('users', 'role'));
    }

    public function create()
    {
        $bagians = Bagian::all();

        $pembimbings = PembimbingProfile::with('user')
            ->whereHas('user', fn($q) => $q->where('role', 'pembimbing'))
            ->get()
            ->mapWithKeys(fn($p) => [$p->id => $p->user->name]);

        return view('admin.pengguna_create', compact('bagians', 'pembimbings'));
    }

    public function store(Request $request)
    {

        $rules = [

            /* USER DASAR */
            'role' => ['required', Rule::in(['admin', 'pembimbing', 'user'])],
            'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z\s\.\'\-]+$/'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'gender' => ['required', Rule::in(['L', 'P'])],
            'tgl_lahir' => ['nullable', 'date', 'before_or_equal:today'],
            'no_hp' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];

        /* ROLE PEMBIMBING */
        if ($request->role === 'pembimbing') {
            $rules += [
                'pembimbing.nip' => ['nullable', 'string', 'max:10'],
                'pembimbing.jabatan' => ['required', 'string', 'max:100'],
                'pembimbing.bagian_id' => ['required', 'exists:bagians,id'],
            ];
        }

        /* ROLE USER */
        if ($request->role === 'user') {
            $rules += [
                'user.nomor_induk' => ['required', 'string', 'max:50'],
                'user.tingkatan' => ['required', 'string', 'max:50'],
                'user.pendidikan' => ['required', 'string', 'max:100'],
                'user.kelas' => ['required', 'string', 'max:50'],
                'user.jurusan' => ['required', 'string', 'max:100'],
                'user.bagian_id' => ['required', 'exists:bagians,id'],
                'user.pembimbing_id' => ['required', 'exists:pembimbing_profiles,id'],
                'user.tgl_masuk' => ['required', 'date'],
                'user.tgl_keluar' => ['required', 'date', 'after_or_equal:user.tgl_masuk'],
            ];
        }

        $validated = $request->validate($rules);

        /* UPLOAD FOTO */
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_users', 'public');
        }

        /* CREATE USER */
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'gender' => $validated['gender'],
            'tgl_lahir' => $validated['tgl_lahir'],
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'foto' => $fotoPath,
        ]);

        /* CREATE PEMBIMBING PROFILE */
        if ($user->role === 'pembimbing') {
            PembimbingProfile::create([
                'user_id' => $user->id,
                'nip' => data_get($validated, 'pembimbing.nip'),
                'jabatan' => data_get($validated, 'pembimbing.jabatan'),
                'bagian_id' => data_get($validated, 'pembimbing.bagian_id'),
            ]);
        }

        /* CREATE USER PROFILE */
        if ($user->role === 'user') {
            UserProfile::create([
                'user_id' => $user->id,
                'nomor_induk' => data_get($validated, 'user.nomor_induk'),
                'tingkatan' => data_get($validated, 'user.tingkatan'),
                'pendidikan' => data_get($validated, 'user.pendidikan'),
                'kelas' => data_get($validated, 'user.kelas'),
                'jurusan' => data_get($validated, 'user.jurusan'),
                'bagian_id' => data_get($validated, 'user.bagian_id'),
                'pembimbing_id' => data_get($validated, 'user.pembimbing_id'),
                'tgl_masuk' => data_get($validated, 'user.tgl_masuk'),
                'tgl_keluar' => data_get($validated, 'user.tgl_keluar'),
            ]);
        }

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Pengguna baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::with([
            'profile.bagian',
            'profile.pembimbing.user',
            'pembimbingProfile.bagian',
            'pembimbingProfile.user',
        ])->findOrFail($id);

        $bagians = Bagian::orderBy('nama')->get();

        $pembimbings = PembimbingProfile::with('user')
            ->whereHas('user', fn($q) => $q->where('role', 'pembimbing'))
            ->get()
            ->mapWithKeys(fn($p) => [$p->id => $p->user->name])
            ->toArray();

        return view('admin.pengguna_edit', compact('user', 'bagians', 'pembimbings'));
    }

    public function update(Request $request, User $pengguna)
    {
        $rules = [

            'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z\s\.\'\-]+$/'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($pengguna->id),],
            'password' => ['nullable', 'confirmed', 'min:6'],
            'gender' => ['required', Rule::in(['L', 'P'])],
            'tgl_lahir' => ['nullable', 'date', 'before_or_equal:today'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'no_hp' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];

        if ($pengguna->role === 'pembimbing') {
            $rules += [
                'pembimbing.nip' => ['required', 'string', 'max:50'],
                'pembimbing.jabatan' => ['required', 'string', 'max:100'],
                'pembimbing.bagian_id' => ['required', 'exists:bagians,id'],
            ];
        }

        if ($pengguna->role === 'user') {
            $rules += [
                'user.nomor_induk' => ['required', 'string', 'max:50'],
                'user.tingkatan' => ['required', 'string', 'max:50'],
                'user.pendidikan' => ['required', 'string', 'max:100'],
                'user.kelas' => ['required', 'string', 'max:50'],
                'user.jurusan' => ['required', 'string', 'max:100'],
                'user.bagian_id' => ['required', 'exists:bagians,id'],
                'user.pembimbing_id' => ['required', 'exists:pembimbing_profiles,id'],
                'user.tgl_masuk' => ['required', 'date'],
                'user.tgl_keluar' => ['required', 'date', 'after_or_equal:user.tgl_masuk'],
            ];
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('foto')) {
            if ($pengguna->foto) {
                Storage::disk('public')->delete($pengguna->foto);
            }

            $pengguna->foto = $request->file('foto')->store('foto_users', 'public');
        }

        $pengguna->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $request->filled('password')
                ? Hash::make($validated['password'])
                : $pengguna->password,
            'gender' => $validated['gender'],
            'tgl_lahir' => $validated['tgl_lahir'],
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'foto' => $pengguna->foto,
        ]);

        if ($pengguna->role === 'pembimbing') {
            PembimbingProfile::updateOrCreate(
                ['user_id' => $pengguna->id],
                [
                    'nip' => data_get($validated, 'pembimbing.nip'),
                    'jabatan' => data_get($validated, 'pembimbing.jabatan'),
                    'bagian_id' => data_get($validated, 'pembimbing.bagian_id'),
                ]
            );
        }

        if ($pengguna->role === 'user') {
            UserProfile::updateOrCreate(
                ['user_id' => $pengguna->id],
                [
                    'nomor_induk' => data_get($validated, 'user.nomor_induk'),
                    'tingkatan' => data_get($validated, 'user.tingkatan'),
                    'pendidikan' => data_get($validated, 'user.pendidikan'),
                    'kelas' => data_get($validated, 'user.kelas'),
                    'jurusan' => data_get($validated, 'user.jurusan'),
                    'bagian_id' => data_get($validated, 'user.bagian_id'),
                    'pembimbing_id' => data_get($validated, 'user.pembimbing_id'),
                    'tgl_masuk' => data_get($validated, 'user.tgl_masuk'),
                    'tgl_keluar' => data_get($validated, 'user.tgl_keluar'),
                ]
            );
        }

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Data pengguna "' . $pengguna->name . '" berhasil diperbarui');
    }

    public function destroy(User $pengguna)
    {
        $nama = $pengguna->name;

        if ($pengguna->foto) {
            Storage::disk('public')->delete($pengguna->foto);
        }

        $pengguna->delete();

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Data pengguna "' . $nama . '" berhasil dihapus');
    }

    public function show($id)
    {
        $pengguna = User::with([
            'profile.bagian',
            'profile.pembimbing.user',
            'pembimbingProfile.bagian'
        ])->findOrFail($id);

        return view('admin.pengguna_show', compact('pengguna'));
    }
}
