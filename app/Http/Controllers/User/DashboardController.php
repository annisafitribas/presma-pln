<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Konfigurasi;
use App\Models\Presensi;
use App\Models\Telat;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $konfigurasi = Konfigurasi::firstOrFail();
        $admin = User::where('role', 'admin')->first();
        $admin = User::where('role', 'admin')->first();

        $adminWa = null;

        if ($admin && $admin->no_hp) {

            $nomor = preg_replace('/[^0-9]/', '', $admin->no_hp);

            if (str_starts_with($nomor, '0')) {
                $adminWa = '62' . substr($nomor, 1);
            } elseif (str_starts_with($nomor, '62')) {
                $adminWa = $nomor;
            } else {
                $adminWa = '62' . $nomor;
            }
        }

        // Presensi hari ini
        $presensiHariIni = Presensi::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->first();

        // Telat pending hari ini (kalau ada)
        $telatPending = Telat::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->where('status', 'pending')
            ->first();

        // Jam masuk / keluar
        $jamMasuk  = $presensiHariIni?->jam_masuk ?? '--:--';
        $jamKeluar = $presensiHariIni?->jam_keluar ?? '--:--';

        // Status hari ini (untuk tampilan)
        $statusPresensi = $presensiHariIni?->status ?? 'belum absen';

        // REKAP BARU:
        // Hadir      : status = hadir
        // Tidak hadir: sakit + izin + alpha
        // Telat      : is_late = 1
        $rekap = Presensi::where('user_id', $user->id)
            ->selectRaw("
                SUM(CASE 
                    WHEN status = 'hadir' THEN 1 
                    ELSE 0 
                END) as hadir,

                SUM(CASE 
                    WHEN status IN ('sakit','izin','alpha') THEN 1 
                    ELSE 0 
                END) as alpha,

                SUM(CASE
                    WHEN is_late = 1 THEN 1
                    ELSE 0
                END) as telat
            ")
            ->first();

        return view('user.dashboard', compact(
            'user',
            'konfigurasi',
            'presensiHariIni',
            'telatPending',
            'jamMasuk',
            'jamKeluar',
            'statusPresensi',
            'rekap',
            'adminWa'
        ));
    }
}
