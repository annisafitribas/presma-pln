<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Konfigurasi;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema; 
use BladeUI\Heroicons\BladeHeroicons;
use App\Models\Telat;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    // buat hosting pakai https
    // public function boot(): void
    // {
    //     // URL::forceScheme('https');
    //     Blade::componentNamespace('BladeUI\Heroicons\BladeHeroicons', 'heroicon');

    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        Blade::componentNamespace('BladeUI\Heroicons\BladeHeroicons', 'heroicon');
        try {

            if (Schema::hasTable('konfigurasi')) {

                $konfigurasi = Konfigurasi::query()
                    ->whereNotNull('nama_apk')
                    ->where('nama_apk', '!=', '')
                    ->orderBy('id')
                    ->first();

                view()->share([
                    'appName' => $konfigurasi?->nama_apk ?? config('app.name'),
                    'appLogo' => $konfigurasi?->logo,
                    'appPt' => $konfigurasi?->nama_pt,
                ]);
            } else {

                view()->share([
                    'appName' => config('app.name'),
                    'appLogo' => null,
                    'appPt' => null,
                ]);
            }
        } catch (\Throwable $e) {

            view()->share([
                'appName' => config('app.name'),
                'appLogo' => null,
                'appPt' => null,
            ]);
        }

        // UNTUK NOTIF NAV ADMIN
        View::composer('*', function ($view) {

            if (Auth::check() && Auth::user()->role === 'admin') {

                $telatPendingCount = Telat::where('status', 'pending')->count();

                $pengajuanPending = Pengajuan::where('status', 'pending')
                    ->count();

                $view->with([
                    'notifTelat' => $telatPendingCount,
                    'notifPengajuan' => $pengajuanPending,
                ]);
            }
        });
    }

    public const HOME = '/dashboard';
}
