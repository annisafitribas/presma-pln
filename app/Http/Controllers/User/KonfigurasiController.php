<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Konfigurasi;

class KonfigurasiController extends Controller
{
    public function index()
    {
        $konfigurasi = Konfigurasi::all(); // ambil semua kantor
        return view('user.konfigurasi', compact('konfigurasi'));
    }
}
