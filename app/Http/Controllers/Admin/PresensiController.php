<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    /**
     * Tampilkan daftar peserta + rekap presensi
     */
    public function index()
    {
        $users = User::where('role', 'user')->get();

        $users->map(function ($user) {
            $rekap = Presensi::where('user_id', $user->id)
                ->selectRaw("
                    SUM(status = 'hadir')        as hadir,
                    SUM(status = 'telat')        as telat,
                    SUM(status = 'sakit')        as sakit,
                    SUM(status = 'izin')         as izin,
                    SUM(status = 'alpha')  as alpha
                ")
                ->first();

            $user->total_hadir = $rekap->hadir ?? 0;
            $user->total_telat = $rekap->telat ?? 0;
            $user->total_sakit = $rekap->sakit ?? 0;
            $user->total_izin  = $rekap->izin ?? 0;
            $user->total_alpha = $rekap->alpha ?? 0;
        });

        return view('admin.presensi_index', compact('users'));
    }

    /**
     * Detail presensi peserta
     */
    public function show(User $user)
    {
        $presensis = Presensi::where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.presensi_show', compact('user', 'presensis'));
    }

    public function update(Request $request, $id)
    {
        $presensi = Presensi::findOrFail($id);

        $rules = [
            'status' => 'required|in:hadir,alpha,izin,sakit',
        ];

        if ($request->status === 'hadir') {
            $rules['jam_masuk'] = 'required';
            $rules['jam_keluar'] = 'required';
            $rules['keterangan'] = 'required';
        }

        if (in_array($request->status, ['izin', 'sakit'])) {
            $rules['keterangan'] = 'required';
        }

        $validated = $request->validate($rules);

        // Kalau alpha → kosongkan jam
        if ($request->status === 'alpha') {
            $validated['jam_masuk'] = null;
            $validated['jam_keluar'] = null;
        }

        // TAMBAHKAN INI
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
            ->get();

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
