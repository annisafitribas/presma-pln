<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserProfile;

class NonaktifkanPesertaMagang extends Command
{
    protected $signature = 'magang:nonaktifkan';
    protected $description = 'Nonaktifkan peserta yang sudah melewati tanggal akhir magang';

    public function handle()
    {
        $hariIni = now()->toDateString();

        $updated = UserProfile::where('status_magang', 'Aktif')
            ->whereNotNull('tgl_keluar')
            ->whereDate('tgl_keluar', '<', $hariIni)
            ->update([
                'status_magang' => 'Tidak Aktif'
            ]);

        $this->info("✅ Berhasil menonaktifkan {$updated} peserta.");
    }
}
