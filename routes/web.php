<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// CONTROLLER

// Admin
use App\Http\Controllers\Admin\KonfigurasiController as AdminKonfigurasiController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\BagianController;
use App\Http\Controllers\Admin\PengajuanController as AdminPengajuanController;
use App\Http\Controllers\Admin\PresensiController as AdminPresensiController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TelatController as AdminTelatController;

// User
use App\Http\Controllers\User\KonfigurasiController as UserKonfigurasiController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\PresensiController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\LaporanController;
use App\Http\Controllers\User\PengajuanController as UserPengajuanController;

// Pembimbing
use App\Http\Controllers\Pembimbing\DashboardController as PembimbingDashboardController;
use App\Http\Controllers\Pembimbing\PesertaController;
use App\Http\Controllers\Pembimbing\PengajuanController as PembimbingPengajuanController;
use App\Http\Controllers\Pembimbing\ProfileController as PembimbingProfileController;
use App\Http\Controllers\Pembimbing\KonfigurasiController as PembimbingKonfigurasiController;

// DEV RESPONSIVE PREVIEW PEMBIMBING
// Route::middleware('auth')->get('/dev-preview-pembimbing', function () {

//     $url = request('url', '/pembimbing/dashboard');

//     return view('dev-preview-pembimbing', compact('url'));
// })->name('dev.preview.pembimbing');

// // DEV RESPONSIVE PREVIEW USER
// Route::middleware('auth')->get('/dev-preview-user', function () {

//     $url = request('url', '/user/dashboard'); // default user

//     return view('dev-preview-user', compact('url'));
// })->name('dev.preview.user');

// // DEV RESPONSIVE PREVIEW
// Route::middleware('auth')->get('/dev-preview', function () {

//     $url = request('url', '/admin/dashboard'); // default kalau kosong

//     return view('dev-preview', compact('url'));
// })->name('dev.preview');

// HOME
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    Route::get('/cek-bahasa', function () {
        return __('validation.required', ['attribute' => 'Email']);
    });

    return match (Auth::user()->role) {
        'admin'       => redirect()->route('admin.dashboard'),
        'pembimbing' => redirect()->route('pembimbing.dashboard'),
        'user'        => redirect()->route('user.dashboard'),
        default       => abort(403),
    };
});

Route::middleware(['auth', 'role:pembimbing'])
    ->prefix('pembimbing')
    ->name('pembimbing.')
    ->group(function () {

        Route::get('/dashboard', [PembimbingDashboardController::class, 'index'])->name('dashboard');

        Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta');

        Route::get('/peserta/{user}', [PesertaController::class, 'show'])->name('peserta.show');

        Route::get('/pengajuan', [PembimbingPengajuanController::class, 'index'])->name('pengajuan');

        Route::get('/pengajuan/{pengajuan}', [PembimbingPengajuanController::class, 'show'])->name('pengajuan.show');

        Route::get('/profile', [PembimbingProfileController::class, 'index'])->name('profile.index');

        Route::get('/profile/edit', [PembimbingProfileController::class, 'edit'])->name('profile.edit');

        Route::put('/profile', [PembimbingProfileController::class, 'update'])->name('profile.update');

        Route::put('/profile/password', [PembimbingProfileController::class, 'updatePassword'])->name('profile.password.update');

        Route::get('/konfigurasi', [PembimbingKonfigurasiController::class, 'index'])->name('konfigurasi.index');
    });

// ROLE: ADMIN
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('konfigurasi', AdminKonfigurasiController::class);
        Route::resource('pengguna', AkunController::class);
        Route::resource('bagian', BagianController::class);

        Route::get('/pengajuan', [AdminPengajuanController::class, 'index'])->name('pengajuan.index');

        Route::patch('/pengajuan/{id}/update-status', [AdminPengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');

        Route::get('/presensi', [AdminPresensiController::class, 'index'])->name('presensi.index');
        Route::get('/presensi/{user}', [AdminPresensiController::class, 'show'])->name('presensi.show');
        Route::patch('/presensi/{presensi}', [AdminPresensiController::class, 'update'])->name('presensi.update');
        Route::get('/presensi-harian', [AdminPresensiController::class, 'harian'])->name('presensi.harian');

        Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');

        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');

        Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

        Route::get('/telat', [AdminTelatController::class, 'index'])->name('telat.index');
        // Route::patch('/telat/{telat}/approve', [AdminTelatController::class, 'approve'])->name('telat.approve');
        // Route::patch('/telat/{telat}/reject', [AdminTelatController::class, 'reject'])->name('telat.reject');
        Route::patch('/telat/{telat}/update-status', [AdminTelatController::class, 'updateStatus'])->name('telat.updateStatus');
        
    });

// ROLE: USER
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/konfigurasi', [UserKonfigurasiController::class, 'index'])->name('konfigurasi.index');

        // PRESENSI
        Route::get('/presensi', [PresensiController::class, 'create'])->name('presensi.create');
        Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');
        Route::post('/presensi/tidak-hadir', [PresensiController::class, 'tidakHadir'])->name('presensi.alpha');

        // LAPORAN
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export', [LaporanController::class, 'exportPdf'])->name('laporan.export');

        // PROFIL
        Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::put('/password', [UserProfileController::class, 'updatePassword'])->name('password.update');

        // PENGAJUAN
        Route::get('/pengajuan', [UserPengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/create', [UserPengajuanController::class, 'create'])->name('pengajuan.create');
        Route::post('/pengajuan', [UserPengajuanController::class, 'store'])->name('pengajuan.store');
    });


// DEFAULT AUTH
require __DIR__ . '/auth.php';
