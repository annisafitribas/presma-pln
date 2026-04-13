<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konfigurasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class KonfigurasiController extends Controller
{
    public function index()
    {
        $konfigurasi = Konfigurasi ::all();
        return view('admin.konfigurasi_index', compact('konfigurasi'));
    }

    public function create()
    {
        return view('admin.konfigurasi_create');
    }

    public function store(Request $request)
    {
        // NORMALISASI LINK 
        $request->merge([
            'link_maps' => $request->link_maps ?: null,

            'wa_link' => $request->wa_link
                ? (str_starts_with($request->wa_link, 'http')
                    ? $request->wa_link
                    : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $request->wa_link))
                : null,

            'ig_link' => $request->ig_link
                ? (str_starts_with($request->ig_link, 'http')
                    ? $request->ig_link
                    : 'https://instagram.com/' . ltrim($request->ig_link, '@'))
                : null,
        ]);


        // VALIDASI 
        $validated = $request->validate([
            'nama_apk'     => 'required|string|max:255',
            'nama_pt'      => 'required|string|max:255',
            'logo'         => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'alamat'       => 'nullable|string',
            'link_maps' => 'nullable|url|max:255',
            'wa_link'   => 'required|url|max:255',
            'ig_link'   => 'nullable|url|max:255',
            'hari_kerja'   => 'required|array',
            'hari_kerja.*' => 'string',
            'jam_masuk'             => 'required|date_format:H:i:s',
            'jam_keluar'            => 'required|date_format:H:i:s|after:jam_masuk',
            'mulai_istirahat'   => 'required|date_format:H:i:s|after:jam_masuk',
            'selesai_istirahat' => 'required|date_format:H:i:s|after:mulai_istirahat',
            'kantor_lat'   => 'required|numeric',
            'kantor_lng'   => 'required|numeric',
            'radius' => 'required|integer',
            'aturan_presensi' => 'nullable|string',
        ]);

        // NORMALISASI DATA 

        // jam → H:i:s
        $validated['jam_masuk'] = strlen($validated['jam_masuk']) === 5
            ? $validated['jam_masuk'] . ':00'
            : $validated['jam_masuk'];

        $validated['jam_keluar'] = strlen($validated['jam_keluar']) === 5
            ? $validated['jam_keluar'] . ':00'
            : $validated['jam_keluar'];

        $validated['mulai_istirahat'] = strlen($validated['mulai_istirahat']) === 5
            ? $validated['mulai_istirahat'] . ':00'
            : $validated['mulai_istirahat'];

        $validated['selesai_istirahat'] = strlen($validated['selesai_istirahat']) === 5
            ? $validated['selesai_istirahat'] . ':00'
            : $validated['selesai_istirahat'];

        // hari kerja → lowercase
        $validated['hari_kerja'] = collect($validated['hari_kerja'] ?? [])
            ->map(fn($day) => strtolower($day))
            ->values()
            ->toArray();

        // default radius
        $validated['radius'] = $validated['radius'] ?? 100;

        // default koordinat (aman)
        $validated['kantor_lat'] = $validated['kantor_lat'] ?? -3.31686840;
        $validated['kantor_lng'] = $validated['kantor_lng'] ?? 114.59018350;

        // upload logo
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('kantor-logo', 'public');
        }

        Konfigurasi::create($validated);

        Cache::forget('kantor_name');

        return redirect()
            ->route('admin.konfigurasi.index')
            ->with('success', 'Konfigurasi berhasil ditambahkan!');
    }

    public function edit(Konfigurasi $konfigurasi)
    {
        return view('admin.konfigurasi_edit', compact('konfigurasi'));
    }

    public function update(Request $request, Konfigurasi $konfigurasi)
    {
        // NORMALISASI LINK 
        $request->merge([
            // maps: biarkan apa adanya (copy dari Google Maps)
            'link_maps' => $request->link_maps ?: null,

            // WhatsApp: nomor / link
            'wa_link' => $request->wa_link
                ? (str_starts_with($request->wa_link, 'http')
                    ? $request->wa_link
                    : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $request->wa_link))
                : null,

            // Instagram: username / link
            'ig_link' => $request->ig_link
                ? (str_starts_with($request->ig_link, 'http')
                    ? $request->ig_link
                    : 'https://instagram.com/' . ltrim($request->ig_link, '@'))
                : null,
        ]);
        // VALIDASI 
        $validated = $request->validate([
            'nama_apk'     => 'required|string|max:255',
            'nama_pt'      => 'required|string|max:255',
            'logo'         => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'alamat'       => 'nullable|string',
            'link_maps' => 'nullable|url|max:255',
            'wa_link'   => 'required|url|max:255',
            'ig_link'   => 'nullable|url|max:255',
            'hari_kerja'   => 'required|array',
            'hari_kerja.*' => 'string',
            'jam_masuk'             => 'required|date_format:H:i:s',
            'jam_keluar'            => 'required|date_format:H:i:s|after:jam_masuk',
            'mulai_istirahat'   => 'required|date_format:H:i:s|after:jam_masuk',
            'selesai_istirahat' => 'required|date_format:H:i:s|after:mulai_istirahat',
            'kantor_lat'   => 'required|numeric',
            'kantor_lng'   => 'required|numeric',
            'radius' => 'required|integer',
            'aturan_presensi' => 'nullable|string',
        ]);

        // NORMALISASI DATA 

        $validated['jam_masuk'] = strlen($validated['jam_masuk']) === 5
            ? $validated['jam_masuk'] . ':00'
            : $validated['jam_masuk'];

        $validated['jam_keluar'] = strlen($validated['jam_keluar']) === 5
            ? $validated['jam_keluar'] . ':00'
            : $validated['jam_keluar'];

        $validated['mulai_istirahat'] = strlen($validated['mulai_istirahat']) === 5
            ? $validated['mulai_istirahat'] . ':00'
            : $validated['mulai_istirahat'];

        $validated['selesai_istirahat'] = strlen($validated['selesai_istirahat']) === 5
            ? $validated['selesai_istirahat'] . ':00'
            : $validated['selesai_istirahat'];

        $validated['hari_kerja'] = collect($validated['hari_kerja'] ?? [])
            ->map(fn($day) => strtolower($day))
            ->values()
            ->toArray();

        $validated['radius'] = $validated['radius'] ?? 100;

        // fallback koordinat
        $validated['kantor_lat'] = $validated['kantor_lat'] ?? $konfigurasi->kantor_lat;
        $validated['kantor_lng'] = $validated['kantor_lng'] ?? $konfigurasi->kantor_lng;

        // upload logo baru
        if ($request->hasFile('logo')) {
            if ($konfigurasi->logo && Storage::disk('public')->exists($konfigurasi->logo)) {
                Storage::disk('public')->delete($konfigurasi->logo);
            }
            $validated['logo'] = $request->file('logo')->store('kantor-logo', 'public');
        }

        $konfigurasi->update($validated);

        Cache::forget('kantor_name');

        return redirect()
            ->route('admin.konfigurasi.index')
            ->with('success', 'Data Konfigurasi berhasil diperbarui!');
    }
}
