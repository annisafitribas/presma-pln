<x-appuser-layout>
    <x-slot name="header">
        <span class="font-semibold text-[#0D1B2A]">Konfigurasi</span>
    </x-slot>

    <div class="space-y-4 mb-6">
        @php
            $konfigurasi = $konfigurasi->first();
        @endphp

        @if ($konfigurasi)

            {{-- HEADER KANTOR --}}
            <x-card>
                <div class="flex items-center gap-4">

                    {{-- LOGO --}}
                    <div
                        class="w-14 h-14 rounded-xl flex items-center justify-center overflow-hidden
            {{ $konfigurasi->logo ? '' : 'bg-blue-50 border' }}">

                        @if ($konfigurasi->logo)
                            <img src="{{ asset('storage/' . $konfigurasi->logo) }}"
                                class="max-w-full max-h-full object-contain">
                        @else
                            <x-heroicon-o-building-office class="w-7 h-7 text-blue-600" />
                        @endif

                    </div>

                    {{-- INFO --}}
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">
                            {{ $konfigurasi->nama_apk ?? 'Nama Kantor Belum Diatur' }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            Informasi operasional kantor
                        </p>
                    </div>

                </div>
            </x-card>

            {{-- JAM OPERASIONAL --}}
            <x-card class="space-y-4">

                <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                    <x-heroicon-o-clock class="w-5 h-5 text-blue-600" />
                    Jam Operasional
                </h3>
                <x-show-item label="Hari Kerja" :value="is_array($konfigurasi->hari_kerja)
                    ? collect($konfigurasi->hari_kerja)->map(fn($hari) => ucfirst($hari))->implode(', ')
                    : 'Tidak diatur'" />

                {{-- Bidang JAM --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">

                    {{-- JAM KERJA --}}
                    <x-show-item label="Jam Kerja" :value="($konfigurasi?->jam_masuk
                        ? \Carbon\Carbon::parse($konfigurasi->jam_masuk)->format('H:i')
                        : '07:45') .
                        ' - ' .
                        ($konfigurasi?->jam_keluar
                            ? \Carbon\Carbon::parse($konfigurasi->jam_keluar)->format('H:i')
                            : '17:00') .
                        ' WITA'" />

                    {{-- JAM ISTIRAHAT --}}
                    <x-show-item label="Jam Istirahat" :value="$konfigurasi?->mulai_istirahat && $konfigurasi?->selesai_istirahat
                        ? \Carbon\Carbon::parse($konfigurasi->mulai_istirahat)->format('H:i') .
                            ' - ' .
                            \Carbon\Carbon::parse($konfigurasi->selesai_istirahat)->format('H:i') .
                            ' WITA'
                        : 'Tidak diatur'" />

                </div>

            </x-card>

            {{-- IDENTITAS KANTOR --}}
            <x-card class="space-y-4">
                <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                    <x-heroicon-o-identification class="w-5 h-5 text-blue-600" />
                    Identitas Kantor
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                    <x-show-item label="Alamat" :value="$konfigurasi->alamat ?? '-'" />
                    <x-show-item label="Koordinat" :value="$konfigurasi->kantor_lat && $konfigurasi->kantor_lng
                        ? $konfigurasi->kantor_lat . ', ' . $konfigurasi->kantor_lng
                        : '-'" />
                    <x-show-item label="Radius Absen" :value="$konfigurasi->radius ? $konfigurasi->radius . ' meter' : 'WFA'" />
                </div>
            </x-card>

            {{-- LOKASI & KONTAK --}}
            <x-card class="space-y-4">
                <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                    <x-heroicon-o-map class="w-5 h-5 text-blue-600" />
                    Lokasi & Kontak
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm ">

                    <x-info label="Google Maps" :value="$konfigurasi->link_maps ? 'Klik untuk melihat maps' : '-'" :link="$konfigurasi->link_maps" />

                    <x-info label="WhatsApp" :value="$konfigurasi->wa_link ? str_replace('https://wa.me/', '', $konfigurasi->wa_link) : '-'" :link="$konfigurasi->wa_link" />

                    <x-info label="Instagram" :value="$konfigurasi->ig_link ? '@' . basename($konfigurasi->ig_link) : '-'" :link="$konfigurasi->ig_link" />
                </div>
            </x-card>

            {{-- ATURAN PRESENSI --}}
            <x-card>
                <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700 -mb-6">
                    <x-heroicon-o-document-text class="w-5 h-5 text-blue-600" />
                    Aturan Presensi
                </h3>

                @if ($konfigurasi->aturan_presensi)
                    <div class="text-sm text-gray-700 whitespace-pre-line leading-relaxed">
                        {{ $konfigurasi->aturan_presensi }}
                    </div>
                @else
                    <div class="text-sm text-gray-400">
                        Aturan presensi belum diatur.
                    </div>
                @endif
            </x-card>
        @else
            {{-- EMPTY STATE --}}
            <x-card class="text-center py-10">
                <x-heroicon-o-building-office class="w-14 h-14 text-gray-300 mx-auto mb-4" />
                <p class="text-gray-500 text-sm">
                    Informasi kantor belum tersedia.<br>
                    Silakan hubungi admin untuk detail lebih lanjut.
                </p>
            </x-card>

        @endif

    </div>
</x-appuser-layout>
