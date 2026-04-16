<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembimbingProfile extends Model
{
    protected $table = 'pembimbing_profiles';

    protected $fillable = [
        'user_id',
        'bidang_id',
        'nip',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function mentees()
    {
        return $this->hasMany(UserProfile::class, 'pembimbing_id');
    }

    /**
     * Alias kompatibilitas kode lama
     */
    public function usersDibimbing()
    {
        return $this->mentees();
    }
}
