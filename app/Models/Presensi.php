<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensis';

    protected $fillable = [
        'user_id',
        'konfigurasi_id',
        'tanggal',

        'status',

        'is_late',
        'late_minutes',

        'jam_masuk',
        'jam_keluar',

        'lat_masuk',
        'lng_masuk',
        'lat_keluar',
        'lng_keluar',

        'locked',
        'keterangan',
        'pengajuan_id',
        'updated_by',
    ];

    protected $casts = [
        'tanggal'      => 'date',
        'locked'       => 'boolean',
        'is_late'      => 'boolean',
        'late_minutes' => 'integer',
    ];

    // hari ini tidak boleh izin manual.
    public static function getPreviousIfShouldForce($userId, $tanggal)
    {
        $yesterday = \Carbon\Carbon::parse($tanggal)->subDay();

        $last = self::where('user_id', $userId)
            ->whereDate('tanggal', $yesterday)
            ->first();

        if (!$last) {
            return null;
        }

        if ($last->status !== 'hadir' && is_null($last->pengajuan_id)) {
            return $last;
        }

        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function konfigurasi()
    {
        return $this->belongsTo(Konfigurasi::class);
    }

    // Relasi ke pengajuan telat (kalau kamu pakai presensi_id di tabel pengajuan_telats)
    public function pengajuanTelat()
    {
        return $this->hasOne(Telat::class, 'presensi_id');
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    /** Presensi sudah final (keluar / alpha / sudah dikunci) */
    public function isLocked(): bool
    {
        return $this->locked === true;
    }

    /** Bisa absen masuk */
    public function bisaMasuk(): bool
    {
        return is_null($this->jam_masuk)
            && $this->status !== 'alpha'
            && !$this->locked;
    }

    /** Bisa absen keluar */
    public function bisaKeluar(): bool
    {
        return !is_null($this->jam_masuk)
            && is_null($this->jam_keluar)
            && $this->status !== 'alpha'
            && !$this->locked;
    }

    public static function statusOptions(): array
    {
        return [
            'hadir'       => 'Hadir',
            'sakit'       => 'Sakit',
            'izin'        => 'Izin',
            'alpha' => 'Alpha',
        ];
    }
    
    public function updatedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }
}
