<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// awal bulan
Schedule::command('sync:harilibur')
    ->monthlyOn(1, '07:00');

// akhir bulan
Schedule::command('sync:harilibur')
    ->dailyAt('23:55')
    ->when(fn() => now()->isLastOfMonth());

Schedule::call(function () {

    $konfigurasi = \App\Models\Konfigurasi::first();

    if (!$konfigurasi) return;
    if (!$konfigurasi->isHariKerjaFinal()) return;

    $batas = $konfigurasi->batasAlphaPulang();

    if (!now()->greaterThanOrEqualTo($batas)) return;

    $key = 'alpha_done_' . now()->toDateString();

    if (cache()->has($key)) return;

    Artisan::call('presensi:tandai-alpha');

    // expire otomatis (tidak perlu clear cache)
    cache()->put($key, true, now()->addHours(6));
})
    ->name('presensi-alpha-once')
    ->everyMinute()
    ->withoutOverlapping(10);

Schedule::command('magang:nonaktifkan')
    ->dailyAt('23:00')
    ->withoutOverlapping();
