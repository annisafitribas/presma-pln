<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Konfigurasi;

class KonfigurasiController extends Controller
{
    public function index()
    {
        $konfigurasi = Konfigurasi::all();
        return view('pembimbing.konfigurasi', compact('konfigurasi'));
    }
}
