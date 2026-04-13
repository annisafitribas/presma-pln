<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Telat;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TelatController extends Controller
{
    /*
    | LIST TELAT
    */
    public function index(Request $request)
    {
        $query = Telat::with(['user', 'konfigurasi']);

        /*
    | FILTER TANGGAL (HARI INI)
    */
        if ($request->tanggal === 'today') {
            $query->whereDate('tanggal', Carbon::today());
        }

        /*
    | FILTER STATUS
    */
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $telats = $query->latest()->get();

        return view('admin.telat', compact('telats'));
    }

    /*
    | UPDATE STATUS TELAT
    */
    public function updateStatus(Request $request, Telat $telat)
    {
        /*
        | WAJIB: Inject telat_id agar modal bisa reopen saat error
        */
        $request->merge([
            'telat_id' => $telat->id
        ]);

        /*
        | VALIDATION
        */
        $request->validate([
            'status'        => 'required|in:approved,rejected',
            'catatan_admin' => 'required|string|max:500',

        ]);

        /*
        | CEK JIKA SUDAH DIPROSES
        */
        if ($telat->status !== 'pending') {
            return back()->with('error', '⚠️ Pengajuan sudah diproses.');
        }

        /*
        | UPDATE STATUS TELAT
        */
        $telat->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'approved_by'   => Auth::id(),
            'approved_at'   => now(),
        ]);

        // diterima
        if ($request->status === 'approved') {

            $presensi = Presensi::where('user_id', $telat->user_id)
                ->whereDate('tanggal', Carbon::parse($telat->tanggal)->toDateString())
                ->first();

            $jamKantor = Carbon::parse($telat->konfigurasi->jam_masuk);
            $jamMasuk  = Carbon::parse($telat->jam_masuk);

            if ($presensi) {

                $presensi->update([
                    'status'       => 'hadir',
                    'is_late'      => true,
                    'late_minutes' => max(0, $jamMasuk->diffInMinutes($jamKantor)),
                ]);
            } else {

                $presensi = Presensi::create([
                    'user_id'      => $telat->user_id,
                    'konfigurasi_id'    => $telat->konfigurasi_id,
                    'tanggal'      => $telat->tanggal,
                    'jam_masuk'    => $telat->jam_masuk,
                    'lat_masuk'    => $telat->lat_masuk,
                    'lng_masuk'    => $telat->lng_masuk,
                    'status'       => 'hadir',
                    'is_late'      => true,
                    'late_minutes' => max(0, $jamMasuk->diffInMinutes($jamKantor)),
                    'locked'       => false,
                ]);
            }

            $telat->update([
                'presensi_id' => $presensi->id,
            ]);
        }


        if ($request->status === 'rejected') {

            $presensi = Presensi::where('user_id', $telat->user_id)
                ->whereDate('tanggal', Carbon::parse($telat->tanggal)->toDateString())
                ->first();

            if ($presensi) {
                $presensi->update([
                    'status'       => 'alpha',
                    'jam_masuk'    => null,
                    'jam_keluar'   => null,
                    'lat_masuk'    => null,
                    'lng_masuk'    => null,
                    'lat_keluar'   => null,
                    'lng_keluar'   => null,
                    'is_late'      => false,
                    'late_minutes' => null,
                    'locked'       => true,
                    'keterangan'   => 'Alpha, presensi keterlambatan ditolak admin',
                ]);
            } else {
                Presensi::create([
                    'user_id'    => $telat->user_id,
                    'konfigurasi_id'  => $telat->konfigurasi_id,
                    'tanggal'    => $telat->tanggal,
                    'status'     => 'alpha',
                    'locked'     => true,
                    'keterangan' => 'Alpha, presensi keterlambatan ditolak admin',
                ]);
            }

            $telat->update([
                'presensi_id' => null
            ]);
        }

        $nama = $telat->user->name;

        $aksi = $request->status === 'approved'
            ? 'diverifikasi'
            : 'ditolak';

        return back()->with(
            'success',
            'Pengajuan keterlambatan "' . $nama . '" berhasil ' . $aksi
        );
    }
}
