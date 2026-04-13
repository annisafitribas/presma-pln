<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Presensi;
use App\Models\User;
use App\Models\Konfigurasi;
use App\Models\Telat;

class TandaiAlpha extends Command
{
    protected $signature = 'presensi:tandai-alpha';
    protected $description = 'Finalisasi kehadiran harian dan tandai alpha otomatis';

    public function handle()
    {
        $hariIni = now()->toDateString();
        $konfigurasi  = Konfigurasi::first();

        if (!$konfigurasi) {
            $this->info("Konfigurasi  tidak ditemukan.");
            return;
        }

        // Skip kalau libur
        if (!$konfigurasi->isHariKerjaFinal($hariIni)) {
            $this->info("Hari ini bukan hari kerja / libur.");
            return;
        }

        // pakai batas alpha (konsisten dengan scheduler)
        $batasAlpha = $konfigurasi->batasAlphaPulang();

        if (now()->lessThan($batasAlpha)) {
            $this->info("Belum waktunya alpha (menunggu jam pulang).");
            return;
        }

        // ambil user magang aktif
        $users = User::with('profile')
            ->where('role', 'user')
            ->whereHas('profile', function ($q) {
                $q->where('status_magang', 'Aktif');
            })
            ->get();

        // ambil semua presensi hari ini (1x query)
        $presensiMap = Presensi::whereDate('tanggal', $hariIni)
            ->get()
            ->keyBy('user_id');

        // ambil telat pending (1x query)
        $telatMap = Telat::whereDate('tanggal', $hariIni)
            ->where('status', 'pending')
            ->get()
            ->keyBy('user_id');

        $totalAlpha = 0;
        $totalNoCheckout = 0;

        foreach ($users as $user) {

            $presensiHariIni = $presensiMap[$user->id] ?? null;
            $telatPending    = isset($telatMap[$user->id]);

            // Skip kalau sudah dikunci
            if ($presensiHariIni && $presensiHariIni->locked) {
                continue;
            }

            // Skip telat pending
            if ($telatPending) {
                continue;
            }

            // Skip izin / sakit
            if ($presensiHariIni && in_array($presensiHariIni->status, ['izin', 'sakit'])) {
                continue;
            }

            //Tidak ada presensi → ALPHA
            if (!$presensiHariIni) {

                Presensi::create([
                    'user_id'    => $user->id,
                    'konfigurasi_id'  => $konfigurasi->id,
                    'tanggal'    => $hariIni,
                    'status'     => 'alpha',
                    'keterangan' => 'Alpha otomatis karena tidak melakukan presensi',
                    'locked'     => true,
                ]);

                $totalAlpha++;
                continue;
            }

            //Tidak absen masuk → ALPHA
            if (is_null($presensiHariIni->jam_masuk)) {

                $presensiHariIni->update([
                    'status'     => 'alpha',
                    'keterangan' => 'Alpha otomatis (tidak absen masuk)',
                    'locked'     => true,
                ]);

                $totalAlpha++;
                continue;
            }

            // ⚠️ Tidak absen pulang
            if (is_null($presensiHariIni->jam_keluar)) {

                $presensiHariIni->update([
                    'status'     => 'hadir',
                    'keterangan' => 'Tidak absen pulang',
                    'locked'     => true,
                ]);

                $totalNoCheckout++;
                continue;
            }

            // Sudah lengkap → kunci
            $presensiHariIni->update([
                'locked' => true,
            ]);
        }

        $this->info("✅ Finalisasi selesai:");
        $this->info("- Total Alpha: {$totalAlpha}");
        $this->info("- Tidak absen pulang: {$totalNoCheckout}");
    }
}
