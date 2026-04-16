<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Telat;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TelatController extends Controller
{
    public function index(Request $request)
    {
        $query = Telat::with(['user', 'konfigurasi']);

        if ($request->tanggal === 'today') {
            $query->whereDate('tanggal', Carbon::today());
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $telats = $query
            ->orderByRaw("
                CASE 
                    WHEN status = 'pending' THEN 1
                    WHEN status = 'approved' THEN 2
                    ELSE 3
                END
            ")
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.telat', compact('telats'));
    }

    public function updateStatus(Request $request, Telat $telat)
    {
        $request->merge([
            'telat_id' => $telat->id
        ]);

        $request->validate([
            'status'        => 'required|in:approved,rejected',
            'catatan_admin' => 'required|string|max:500',
        ]);

        if ($telat->status !== 'pending') {
            return back()->with('error', '⚠️ Pengajuan sudah diproses.');
        }

        $path = $telat->bukti;

        if ($request->hasFile('bukti')) {

            if ($telat->bukti && Storage::disk('public')->exists($telat->bukti)) {
                Storage::disk('public')->delete($telat->bukti);
            }

            $file = $request->file('bukti');
            $ext  = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {

                $manager = new ImageManager(new Driver());

                $image = $manager->read($file)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->toJpeg(70);

                $path = 'bukti/telat/' . uniqid() . '.' . $ext;

                Storage::disk('public')->put($path, $image);
            } else {
                $path = $file->store('bukti/telat', 'public');
            }
        }

        if ($request->status === 'approved' && !$path) {
            return back()->with('error', '⚠️ Tidak bisa menyetujui tanpa bukti.');
        }

        DB::beginTransaction();

        try {

            $telat->update([
                'status'        => $request->status,
                'catatan_admin' => $request->catatan_admin,
                'approved_by'   => Auth::id(),
                'approved_at'   => now(),
                'bukti'         => $path,
            ]);

            $presensi = Presensi::where('user_id', $telat->user_id)
                ->whereDate('tanggal', $telat->tanggal)
                ->first();

            if ($request->status === 'approved') {

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
                        'user_id'        => $telat->user_id,
                        'konfigurasi_id' => $telat->konfigurasi_id,
                        'tanggal'        => $telat->tanggal,
                        'jam_masuk'      => $telat->jam_masuk,
                        'lat_masuk'      => $telat->lat_masuk,
                        'lng_masuk'      => $telat->lng_masuk,
                        'status'         => 'hadir',
                        'is_late'        => true,
                        'late_minutes'   => max(0, $jamMasuk->diffInMinutes($jamKantor)),
                        'locked'         => false,
                    ]);
                }

                $telat->update([
                    'presensi_id' => $presensi->id,
                ]);
            }

            if ($request->status === 'rejected') {

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
                        'user_id'        => $telat->user_id,
                        'konfigurasi_id' => $telat->konfigurasi_id,
                        'tanggal'        => $telat->tanggal,
                        'status'         => 'alpha',
                        'locked'         => true,
                        'keterangan'     => 'Alpha, presensi keterlambatan ditolak admin',
                    ]);
                }

                $telat->update([
                    'presensi_id' => null
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan sistem');
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
