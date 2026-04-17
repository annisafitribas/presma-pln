<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Konfigurasi;
use App\Models\Presensi;
use App\Models\Telat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresensiController extends Controller
{
    /*
    FORM PRESENSI
    */
    public function create()
    {
        $user   = Auth::user();
        $konfigurasi = Konfigurasi::firstOrFail();

        if (!$konfigurasi->isHariKerjaFinal()) {
            return redirect()->route('user.dashboard')
                ->with('error', '⛔ Presensi tidak tersedia karena hari libur atau bukan hari kerja');
        }

        $presensiHariIni = Presensi::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->first();

        $bulanIni = now()->month;
        $tahunIni = now()->year;

        //  Cek izin/sakit bulan ini
        $sudahIzinBulanIni = Presensi::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('status', ['izin', 'sakit'])
            ->exists();

        //  Cek alpha bulan ini
        $sudahAlphaBulanIni = Presensi::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'alpha')
            ->exists();
        $bolehTidakHadirManual = !$sudahIzinBulanIni && !$sudahAlphaBulanIni;
        $bisaPresensiMasuk = !$presensiHariIni || is_null($presensiHariIni->jam_masuk);
        $telatHariIni = Telat::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        $bisaPresensiKeluar =
            $presensiHariIni && $presensiHariIni->jam_masuk;

        $telatPending = Telat::where('user_id', $user->id)
            ->whereDate('tanggal', today())
            ->where('status', 'pending')
            ->first();

        return view('user.presensi', compact(
            'konfigurasi',
            'presensiHariIni',
            'bisaPresensiMasuk',
            'bisaPresensiKeluar',
            'telatPending',
            'bolehTidakHadirManual'
        ));
    }

    /*
    SIMPAN PRESENSI
    */
    public function store(Request $request)
    {
        $user   = Auth::user();
        $konfigurasi = Konfigurasi::firstOrFail();

        if (!$konfigurasi->isHariKerjaFinal()) {
            return redirect()->route('user.dashboard')
                ->with('error', '⛔ Presensi tidak dapat dilakukan karena hari libur');
        }

        $rules = [
            'type' => 'required|in:masuk,keluar,alpha',
        ];

        // jika tidak hadir 
        if ($request->type === 'alpha') {
            $rules['status'] = 'required|in:izin,sakit';
            $rules['keterangan'] = 'required|string|max:255';
        }

        // jika telat (masuk)
        if ($request->type === 'masuk') {
            $rules['latitude']  = 'required|numeric';
            $rules['longitude'] = 'required|numeric';

            // nanti kita paksa alasan kalau telat
        }

        $request->validate($rules);

        /*
        TIDAK HADIR
        */
        if ($request->type === 'alpha') {

            $bulanIni = now()->month;
            $tahunIni = now()->year;

            $sudahIzinBulanIni = Presensi::where('user_id', $user->id)
                ->whereMonth('tanggal', $bulanIni)
                ->whereYear('tanggal', $tahunIni)
                ->whereIn('status', ['izin', 'sakit'])
                ->exists();

            $sudahAlphaBulanIni = Presensi::where('user_id', $user->id)
                ->whereMonth('tanggal', $bulanIni)
                ->whereYear('tanggal', $tahunIni)
                ->where('status', 'alpha')
                ->exists();

            if ($sudahIzinBulanIni || $sudahAlphaBulanIni) {
                return redirect()->route('user.pengajuan.index')
                    ->with('error', 'Tidak dapat menggunakan izin manual bulan ini.');
            }

            $presensi = Presensi::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'tanggal' => today()->toDateString(),
                ],
                [
                    'konfigurasi_id' => $konfigurasi->id,
                    'status'    => 'hadir',
                    'locked'    => false,
                ]
            );


            if ($presensi->isLocked()) {
                return back()->with('error', '⚠️ Presensi hari ini sudah selesai');
            }

            //  CEK BERTURUT-TURUT
            $previous = Presensi::getPreviousIfShouldForce($user->id, today());

            if ($previous) {

                $previous->update([
                    'status'     => 'alpha',
                    'keterangan' => 'Alpha karena tidak hadir berturut-turut',
                    'locked'     => true,
                ]);

                $presensi->update([
                    'status'     => 'alpha',
                    'keterangan' => 'Alpha karena tidak hadir berturut-turut',
                    'locked'     => true,
                ]);

                return redirect()->route('user.dashboard')
                    ->with('auto_alpha', 'Otomatis alpha karena tidak hadir berturut-turut');
            }

            $presensi->update([
                'status'     => $request->status,
                'keterangan' => $request->keterangan,
                'locked'     => true,
            ]);

            $status = $request->status;

            return redirect()->route('user.dashboard')
                ->with('success', ucfirst($status) . ' berhasil disimpan');
        }

        $request->validate([
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // MODE WFA jika radius null / 0
        $isWfa = !$konfigurasi->radius || $konfigurasi->radius == 0;
        if (!$isWfa) {

            $jarak = $this->hitungJarak(
                $konfigurasi->kantor_lat,
                $konfigurasi->kantor_lng,
                $request->latitude,
                $request->longitude
            );

            if ($jarak > $konfigurasi->radius) {
                return back()->with('error', '❌ Kamu berada di luar radius kantor');
            }
        }

        if ($request->type === 'masuk') {
            $presensi = Presensi::where('user_id', $user->id)
                ->whereDate('tanggal', today())
                ->first();

            if ($presensi && $presensi->jam_masuk) {
                return back()->with('error', 'Kamu sudah absen masuk hari ini');
            }
            $jamSekarang = now();
            $jamMasukKantor = Carbon::today()
                ->setTimeFromTimeString($konfigurasi->jam_masuk);
            $lateSeconds = $jamMasukKantor->diffInSeconds($jamSekarang, false);
            if ($lateSeconds > 0) {
                $lateMinutes = ceil($lateSeconds / 60);
                if (!$request->filled('alasan')) {
                    return back()
                        ->with('telat', true)
                        ->with('error', 'Silakan isi alasan keterlambatan.');
                }

                // simpan telat
                $telat = Telat::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'tanggal' => today()->toDateString(),
                    ],
                    [
                        'konfigurasi_id' => $konfigurasi->id,
                        'jam_masuk' => $jamSekarang->format('H:i:s'),
                        'lat_masuk' => $request->latitude,
                        'lng_masuk' => $request->longitude,
                        'alasan' => $request->alasan,
                        'late_minutes' => $lateMinutes,
                        'status' => 'pending',
                    ]
                );

                // simpan presensi juga
                $presensi = Presensi::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'tanggal' => today()->toDateString(),
                    ],
                    [
                        'konfigurasi_id' => $konfigurasi->id,
                        'locked' => false,
                    ]
                );

                $presensi->update([
                    'jam_masuk' => $jamSekarang->format('H:i:s'),
                    'lat_masuk' => $request->latitude,
                    'lng_masuk' => $request->longitude,
                    'status' => 'pending',
                    'is_late' => true,
                    'late_minutes' => $lateMinutes,
                ]);

                $telat->update([
                    'presensi_id' => $presensi->id
                ]);

                return redirect()->route('user.dashboard')
                    ->with('success', 'Presensi terlambat dan menunggu persetujuan admin.');
            }

            $presensi = Presensi::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'tanggal' => today()->toDateString(),
                ],
                [
                    'konfigurasi_id' => $konfigurasi->id,
                    'status'    => 'hadir',
                    'locked'    => false,
                ]
            );
            $presensi->update([
                'jam_masuk'    => $jamSekarang->format('H:i:s'),
                'lat_masuk'    => $request->latitude,
                'lng_masuk'    => $request->longitude,
                'status'       => 'hadir',
                'is_late'      => false,
                'late_minutes' => 0,
            ]);
            return redirect()->route('user.dashboard')
                ->with('success', 'Presensi masuk berhasil');
        }

        if ($request->type === 'keluar') {

            $presensi = Presensi::where('user_id', $user->id)
                ->whereDate('tanggal', today())
                ->first();

            if ($presensi && $presensi->jam_keluar) {
                return back()->with('error', 'Kamu sudah absen keluar hari ini');
            }

            $telat = Telat::where('user_id', $user->id)
                ->whereDate('tanggal', today())
                ->whereIn('status', ['pending', 'approved'])
                ->first();

            if (!$presensi && !$telat) {
                return back()->with('error', 'Kamu belum absen masuk');
            }

            // jika presensi belum ada tapi telat ada
            if (!$presensi && $telat) {

                $presensi = Presensi::create([
                    'user_id' => $user->id,
                    'konfigurasi_id' => $konfigurasi->id,
                    'tanggal' => today(),
                    'jam_masuk' => $telat->jam_masuk,
                    'lat_masuk' => $telat->lat_masuk,
                    'lng_masuk' => $telat->lng_masuk,
                    'status' => 'hadir',
                    'is_late' => true,
                    'late_minutes' => $telat->late_minutes,
                    'locked' => false
                ]);
            }

            $jamMasukUser  = Carbon::parse($presensi->jam_masuk);
            $jamKeluarUser = now();
            $workedSeconds = $jamMasukUser->diffInSeconds($jamKeluarUser);

            // Kurangi istirahat jika overlap
            if ($konfigurasi->mulai_istirahat && $konfigurasi->selesai_istirahat) {
                $istirahatMulai   = $konfigurasi->jamIstirahatMulaiCarbon();
                $istirahatSelesai = $konfigurasi->jamIstirahatSelesaiCarbon();
                if ($istirahatMulai && $istirahatSelesai) {
                    if ($jamMasukUser < $istirahatSelesai && $jamKeluarUser > $istirahatMulai) {
                        $overlapStart = max($jamMasukUser, $istirahatMulai);
                        $overlapEnd   = min($jamKeluarUser, $istirahatSelesai);
                        $workedSeconds -= $overlapStart->diffInSeconds($overlapEnd);
                    }
                }
            }

            $halfWork = $konfigurasi->setengahKerjaDetik();
            if ($workedSeconds < $halfWork) {
                $presensi->update([
                    'jam_keluar' => $jamKeluarUser->format('H:i:s'),
                    'lat_keluar' => $request->latitude,
                    'lng_keluar' => $request->longitude,
                    'status'     => 'alpha',
                    'keterangan' => 'Alpha karena durasi kerja kurang',
                    'locked'     => true,
                ]);

                return redirect()->route('user.dashboard')
                    ->with('error', '❌ Otomatis alpha karena durasi kerja kurang');
            }

            $presensi->update([
                'jam_keluar' => $jamKeluarUser->format('H:i:s'),
                'lat_keluar' => $request->latitude,
                'lng_keluar' => $request->longitude,
                'keterangan' => $request->keterangan,
                'locked'     => true,
            ]);

            return redirect()->route('user.dashboard')
                ->with('success', 'Presensi keluar berhasil');
        }
    }


    private function hitungJarak($lat1, $lon1, $lat2, $lon2): float
    {
        $R = 6371000;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2 +
            cos(deg2rad($lat1)) *
            cos(deg2rad($lat2)) *
            sin($dLon / 2) ** 2;
        return $R * (2 * atan2(sqrt($a), sqrt(1 - $a)));
    }
}
