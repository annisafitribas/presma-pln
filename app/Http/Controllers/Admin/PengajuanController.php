<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Presensi;
use App\Models\Konfigurasi;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with('user')
            ->latest()
            ->get();

        $konfigurasi = Konfigurasi::first();

        return view('admin.pengajuan', compact('pengajuans', 'konfigurasi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'catatan_admin' => 'required|string|max:255',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        // Simpan status lama
        $oldStatus = $pengajuan->status;

        // Update pengajuan
        $pengajuan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        /*
    | JIKA APPROVED
    */
        if ($request->status === 'approved') {

            $konfigurasi = Konfigurasi::firstOrFail();

            $start = Carbon::parse($pengajuan->tgl_mulai);
            $end   = Carbon::parse($pengajuan->tgl_selesai);

            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {

                Presensi::updateOrCreate(
                    [
                        'user_id' => $pengajuan->user_id,
                        'tanggal' => $date->toDateString(),
                    ],
                    [
                        'konfigurasi_id'=> $konfigurasi->id,
                        'status'       => $pengajuan->jenis,
                        'keterangan'   => $pengajuan->keterangan,
                        'pengajuan_id' => $pengajuan->id,
                        'jam_masuk'    => null,
                        'jam_keluar'   => null,
                        'is_late'      => false,
                        'locked'       => true,
                    ]
                );
            }
        }

        /*
    | JIKA REJECTED
    */
        if ($request->status === 'rejected') {

            Presensi::where('pengajuan_id', $pengajuan->id)->delete();
        }
        $nama = $pengajuan->user->name;

        $aksi = $request->status === 'approved'
            ? 'disetujui'
            : 'ditolak';

        return back()->with(
            'success',
            'Status pengajuan "' . $nama . '" berhasil ' . $aksi
        );
    }
}
