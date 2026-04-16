<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\User;
use App\Models\Bidang;
use App\Models\Telat;
use App\Models\Konfigurasi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $konfigurasi = Konfigurasi::first();

        $sudahLewatJamKerja = $konfigurasi
            ? now()->greaterThan(
                Carbon::today()->setTimeFromTimeString($konfigurasi->jam_keluar)
            )
            : false;

        // USER AKTIF
        $users = User::where('role', 'user')
            ->whereHas('profile', function ($q) {
                $q->where('status_magang', 'Aktif');
            })
            ->with(['profile.bidang', 'profile.pembimbing.user'])
            ->get();

        $totalPeserta = $users->count();

        // PRESENSI HARI INI (SIMPLE)
        $presensiHariIni = Presensi::whereDate('tanggal', $today)
            ->get()
            ->keyBy('user_id');

        // STATUS
        $hadir = $presensiHariIni->where('status', 'hadir')->count();
        $izin  = $presensiHariIni->where('status', 'izin')->count();
        $sakit = $presensiHariIni->where('status', 'sakit')->count();

        $totalSudahIsi = $presensiHariIni->count();

        $alphaHariIni = $sudahLewatJamKerja
            ? max($totalPeserta - $totalSudahIsi, 0)
            : 0;

        $terlambat = Telat::whereDate('tanggal', $today)
            ->where('status', 'approved')
            ->count();

        // INTI: BELUM PRESENSI
        $belumPresensi = $users->reject(fn($user) => isset($presensiHariIni[$user->id]));

        $belumAbsen = $belumPresensi->count();

        // STATISTIK
        $totalPembimbing = User::where('role', 'pembimbing')->count();
        $totalAdmin      = User::where('role', 'admin')->count();
        $totalPengguna   = User::count();
        $totalBidang     = Bidang::count();

        return view('admin.dashboard', compact(
            'hadir',
            'terlambat',
            'izin',
            'sakit',
            'alphaHariIni',
            'belumAbsen',
            'belumPresensi',
            'sudahLewatJamKerja',
            'totalPeserta',
            'totalPembimbing',
            'totalAdmin',
            'totalPengguna',
            'totalbidang'
        ));
    }
}
