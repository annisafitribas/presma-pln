<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PengajuanController extends Controller
{
    /**
     * Tampilkan halaman pengajuan user
     */
    public function index()
    {
        $pengajuans = Pengajuan::where('user_id', Auth::id())
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('user.pengajuan', compact('pengajuans'));
    }

    /**
     * Simpan pengajuan izin / sakit
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis'            => ['required', 'in:izin,sakit'],
            'tgl_mulai'    => ['required', 'date', 'after_or_equal:today'],
            'tgl_selesai'  => ['required', 'date', 'after_or_equal:tgl_mulai'],
            'keterangan'       => ['required', 'string', 'max:255'],
            'bukti'            => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ]);

        $tanggalMulai   = Carbon::parse($request->tgl_mulai)->format('Y-m-d');
        $tanggalSelesai = Carbon::parse($request->tgl_selesai)->format('Y-m-d');

        // CEK OVERLAP
        $overlap = Pengajuan::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'disetujui']) // hanya cek yg masih aktif
            ->where(function ($query) use ($tanggalMulai, $tanggalSelesai) {
                $query->whereDate('tgl_mulai', '<=', $tanggalSelesai)
                    ->whereDate('tgl_selesai', '>=', $tanggalMulai);
            })
            ->exists();

        if ($overlap) {
            return back()
                ->withErrors([
                    'tgl_mulai' => 'Tanggal yang dipilih sudah memiliki pengajuan sebelumnya.'
                ])
                ->withInput();
        }

        // UPLOAD FILE
        $file = $request->file('bukti');
        $ext  = strtolower($file->extension());

        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {

            $manager = new ImageManager(new Driver());

            $image = $manager->read($file)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->toJpeg(70);

            $filePath = 'pengajuan/' . uniqid() . '.jpg';

            Storage::disk('public')->put($filePath, $image);
        } else {
            // PDF tetap original
            $filePath = $file->store('pengajuan', 'public');
        }

        // SIMPAN
        Pengajuan::create([
            'user_id'         => Auth::id(),
            'jenis'           => $request->jenis,
            'tgl_mulai'   => $tanggalMulai,
            'tgl_selesai' => $tanggalSelesai,
            'keterangan'      => $request->keterangan,
            'bukti'           => $filePath,
            'status'          => 'pending',
        ]);

        return redirect()
            ->route('user.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dikirim.');
    }
}
