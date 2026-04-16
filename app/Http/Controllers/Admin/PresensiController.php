<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PresensiController extends Controller
{
    /**
     * Tampilkan daftar peserta + rekap presensi
     */
    public function index()
    {
        $users = User::leftJoin('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->where('users.role', 'user')
            ->orderByRaw("
                CASE 
                    WHEN user_profiles.status_magang = 'Aktif' THEN 1
                    ELSE 2
                END
            ")
            ->orderByDesc('users.updated_at')
            ->select('users.*')
            ->paginate(10)
            ->withQueryString();

        $users->getCollection()->transform(function ($user) {

            $rekap = Presensi::where('user_id', $user->id)
                ->selectRaw("
            SUM(status = 'hadir') as hadir,
            SUM(status = 'telat') as telat,
            SUM(status = 'sakit') as sakit,
            SUM(status = 'izin') as izin,
            SUM(status = 'alpha') as alpha
        ")
                ->first();

            $user->total_hadir = $rekap->hadir ?? 0;
            $user->total_telat = $rekap->telat ?? 0;
            $user->total_sakit = $rekap->sakit ?? 0;
            $user->total_izin  = $rekap->izin ?? 0;
            $user->total_alpha = $rekap->alpha ?? 0;

            return $user;
        });

        return view('admin.presensi_index', compact('users'));
    }

    /**
     * Detail presensi peserta
     */
    public function show(User $user)
    {
        $presensis = Presensi::where('user_id', $user->id)
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        return view('admin.presensi_show', compact('user', 'presensis'));
    }

    public function update(Request $request, $id)
    {
        $presensi = Presensi::findOrFail($id);

        $rules = [
            'status' => 'required|in:hadir,alpha,izin,sakit',
            'bukti'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];

        if ($request->status === 'hadir') {
            $rules['jam_masuk'] = 'required';
            $rules['jam_keluar'] = 'required';
            $rules['keterangan'] = 'required';
        }

        if (in_array($request->status, ['izin', 'sakit'])) {
            $rules['keterangan'] = 'required';

            // 🔴 WAJIB bukti kalau belum ada
            if (!$presensi->bukti) {
                $rules['bukti'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
            }
        }

        $validated = $request->validate($rules);

        // alpha → kosongkan jam
        if ($request->status === 'alpha') {
            $validated['jam_masuk'] = null;
            $validated['jam_keluar'] = null;
        }

        if ($request->hasFile('bukti')) {

            if ($presensi->bukti && Storage::disk('public')->exists($presensi->bukti)) {
                Storage::disk('public')->delete($presensi->bukti);
            }

            $file = $request->file('bukti');
            $ext  = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {

                $manager = new ImageManager(new Driver());

                $image = $manager->read($file)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->toJpeg(70);

                $path = 'bukti/presensi/' . uniqid() . '.jpg';

                Storage::disk('public')->put($path, $image);
            } else {
                // PDF dll
                $path = $file->store('bukti/presensi', 'public');
            }

            $validated['bukti'] = $path;
        }

        // simpan admin
        $validated['updated_by'] = Auth::id();

        $presensi->update($validated);

        $nama = optional($presensi->user)->name ?? 'User';
        $tanggal = \Carbon\Carbon::parse($presensi->tanggal)->format('d M Y');

        return back()->with(
            'success',
            'Presensi "' . $nama . '" pada tanggal ' . $tanggal . ' berhasil diperbarui'
        );
    }
    public function harian()
    {
        $today = \Carbon\Carbon::today();

        $users = User::with(['profile.bagian', 'profile.pembimbing.user'])
            ->where('role', 'user')
            ->whereHas('profile', function ($q) {
                $q->where('status_magang', 'Aktif');
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $presensiHariIni = Presensi::whereDate('tanggal', $today)
            ->get()
            ->keyBy('user_id');

        return view('admin.presensi_harian', compact(
            'today',
            'users',
            'presensiHariIni'
        ));
    }
}
