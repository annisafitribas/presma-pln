<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Presensi;
use App\Models\Konfigurasi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $sort = $request->get('sort', 'desc');
        $presensi = Presensi::with('updatedBy')
            ->where('user_id', $user->id)
            ->orderBy('tanggal', $sort)
            ->paginate(10)
            ->withQueryString();

        return view('user.laporan', compact(
            'presensi',
            'user',
            'sort'
        ));
    }

    public function exportPdf(Request $request)
    {
        $user   = Auth::user();
        $konfigurasi = Konfigurasi::first();

        $query = Presensi::where('user_id', $user->id);

        // FILTER RENTANG TANGGAL (OPTIONAL)
        if ($request->filled('from') && $request->filled('to')) {

            $request->validate([
                'from' => ['required', 'date', 'before_or_equal:today'],
                'to'   => ['required', 'date', 'after_or_equal:from', 'before_or_equal:today'],
            ], [
                'from.before_or_equal' => 'Tanggal mulai tidak boleh melebihi hari ini.',
                'to.after_or_equal'    => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
                'to.before_or_equal'   => 'Tanggal selesai tidak boleh melebihi hari ini.',
            ]);

            $query->whereBetween('tanggal', [
                $request->from,
                $request->to
            ]);
        }

        $presensi = $query->orderBy('tanggal', 'asc')->get();

        // CEK DATA KOSONG
        if ($presensi->isEmpty()) {
            return redirect()
                ->route('user.laporan.index')
                ->with('error', 'Tidak ada data untuk diexport.');
        }

        // REKAP
        $rekap = [
            'hadir' => $presensi->where('status', 'hadir')->where('is_late', false)->count(),
            'telat' => $presensi->where('status', 'hadir')->where('is_late', true)->count(),
            'sakit' => $presensi->where('status', 'sakit')->count(),
            'izin'  => $presensi->where('status', 'izin')->count(),
            'alpha' => $presensi->where('status', 'alpha')->count(),
        ];

        $pdf = Pdf::loadView(
            'user.laporan_pdf',
            compact('presensi', 'rekap', 'user', 'konfigurasi')
        );

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Laporan_Presensi.pdf"');
    }
}
