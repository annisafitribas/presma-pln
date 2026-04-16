<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telat extends Model
{
    use HasFactory;

    protected $table = 'telats';

    protected $fillable = [
        'user_id',
        'konfigurasi_id',
        'tanggal',
        'presensi_id',

        'jam_masuk',
        'lat_masuk',
        'lng_masuk',

        'alasan',

        'status',
        'catatan_admin',

        'approved_by',
        'approved_at',
        'bukti',
    ];

    protected $casts = [
        'tanggal'     => 'date',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function konfigurasi()
    {
        return $this->belongsTo(Konfigurasi::class);
    }

    public function presensi()
    {
        return $this->belongsTo(Presensi::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
