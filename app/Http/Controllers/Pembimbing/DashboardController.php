<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Presensi;
use App\Models\Pengajuan;
use App\Models\Telat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pembimbing = Auth::user();
        $today = Carbon::today();

        /*
        | AMBIL PESERTA AKTIF YANG DIBIMBING
        */

        $peserta = User::where('role', 'user')
            ->whereHas('profile', function ($q) use ($today) {
                $q->where('status_magang', 'Aktif')
                    ->whereDate('tgl_masuk', '<=', $today)
                    ->whereDate('tgl_keluar', '>=', $today);
            })
            ->whereHas('profile.pembimbing.user', function ($q) use ($pembimbing) {
                $q->where('users.id', $pembimbing->id);
            })
            ->with('profile.bagian')
            ->get();

        $pesertaIds = $peserta->pluck('id');

        /*
        | PRESENSI HARI INI
        */

        $presensiHariIni = Presensi::whereIn('user_id', $pesertaIds)
            ->whereDate('tanggal', $today)
            ->get()
            ->keyBy('user_id');

        /*
        | STATISTIK HARI INI
        */

        $hadir = Presensi::whereIn('user_id', $pesertaIds)
            ->whereDate('tanggal', $today)
            ->where('status', 'hadir')
            ->count();

        $telat = Telat::whereIn('user_id', $pesertaIds)
            ->whereDate('tanggal', $today)
            ->where('status', 'approved')
            ->count();

        $izin = Presensi::whereIn('user_id', $pesertaIds)
            ->whereDate('tanggal', $today)
            ->where('status', 'izin')
            ->count();

        $sakit = Presensi::whereIn('user_id', $pesertaIds)
            ->whereDate('tanggal', $today)
            ->where('status', 'sakit')
            ->count();

        $alphaHariIni = Presensi::whereIn('user_id', $pesertaIds)
            ->whereDate('tanggal', $today)
            ->where('status', 'alpha')
            ->count();

        $belumPresensi = $peserta->count() - $presensiHariIni->count();

        /*
        | TOTAL KESELURUHAN (ALL TIME)
        */

        $totalPeserta = $peserta->count();

        $totalHadir = Presensi::whereIn('user_id', $pesertaIds)
            ->where('status', 'hadir')
            ->count();

        $totalTelat = Telat::whereIn('user_id', $pesertaIds)
            ->where('status', 'approved')
            ->count();

        $totalIzin = Presensi::whereIn('user_id', $pesertaIds)
            ->where('status', 'izin')
            ->count();

        $totalSakit = Presensi::whereIn('user_id', $pesertaIds)
            ->where('status', 'sakit')
            ->count();

        $totalAlpha = Presensi::whereIn('user_id', $pesertaIds)
            ->where('status', 'alpha')
            ->count();

        $totalKeseluruhan = $totalHadir + $totalTelat + $totalIzin + $totalSakit + $totalAlpha;

        /*
        | PENGAJUAN PENDING
        */

        $izinPending = Pengajuan::whereIn('user_id', $pesertaIds)
            ->where('status', 'pending')
            ->latest()
            ->get();

        /*
        | TOTAL HARI INI (PROGRESS BAR)
        */

        $total = $hadir + $telat + $izin + $sakit + $alphaHariIni + $belumPresensi;

        return view('pembimbing.dashboard', compact(
            'peserta',
            'presensiHariIni',
            'hadir',
            'telat',
            'izin',
            'sakit',
            'alphaHariIni',
            'belumPresensi',
            'izinPending',
            'total',

            // TOTAL KESELURUHAN
            'totalPeserta',
            'totalHadir',
            'totalTelat',
            'totalIzin',
            'totalSakit',
            'totalAlpha',
            'totalKeseluruhan'
        ));
    }
}
