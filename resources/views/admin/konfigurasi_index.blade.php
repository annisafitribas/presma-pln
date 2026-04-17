<x-appadmin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-[#0D1B2A]">
            Konfigurasi
        </div>
    </x-slot>

    <div class="container mx-auto">
        @php $konfigurasi = $konfigurasi->first(); @endphp

        <x-card>
            @if ($konfigurasi)

                {{-- HEADER --}}
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">

                    {{-- KIRI --}}
                    <div class="flex items-center gap-4">
                        @if ($konfigurasi->logo)
                            <img src="{{ asset('storage/' . $konfigurasi->logo) }}"
                                class="h-12 w-12 object-contain rounded-lg border bg-white p-1">
                        @else
                            <x-heroicon-o-building-office class="w-10 h-10 text-indigo-600" />
                        @endif

                        <div>
                            <h2 class="text-xl font-bold">
                                {{ $konfigurasi->nama_apk ?? 'Nama konfigurasi Belum Diatur' }}
                            </h2>
                            <p class="text-sm text-gray-500">
                                Informasi & pengaturan operasional kantor
                            </p>
                        </div>
                    </div>

                    {{-- KANAN --}}
                    <div class="w-full md:w-auto">
                        <x-button-link href="{{ route('admin.konfigurasi.edit', $konfigurasi->id) }}" variant="primary"
                            icon="heroicon-o-pencil-square" class="w-full md:w-auto justify-center">
                            Edit
                        </x-button-link>
                    </div>

                </div>

                {{-- 3 KOLOM --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

                    {{-- IDENTITAS --}}
                    <x-card title="Identitas Kantor" icon="heroicon-o-identification">
                        <div class="space-y-4">
                            <x-info label="Nama Perusahaaan" :value="$konfigurasi->nama_pt ?? '-'" />
                            <x-info label="Nama Aplikasi" :value="$konfigurasi->nama_apk ?? '-'" />
                            <x-info label="Alamat" :value="$konfigurasi->alamat ?? '-'" />
                            <x-info label="Radius Absen" :value="$konfigurasi->wfa == 0
                                ? 'WFA'
                                : ($konfigurasi->radius
                                    ? $konfigurasi->radius . ' meter'
                                    : '-')" />
                        </div>
                    </x-card>

                    {{-- OPERASIONAL --}}
                    <x-card title="Operasional" icon="heroicon-o-clock">
                        <div class="space-y-4">
                            <x-info label="Hari Kerja" :value="is_array($konfigurasi->hari_kerja)
                                ? collect($konfigurasi->hari_kerja)->map(fn($h) => ucfirst($h))->implode(', ')
                                : '-'" />

                            <x-info label="Jam Kerja" :value="$konfigurasi->jam_masuk && $konfigurasi->jam_keluar
                                ? $konfigurasi->jam_masuk . ' – ' . $konfigurasi->jam_keluar
                                : '-'" />

                            <x-info label="Jam Istirahat" :value="$konfigurasi->jamIstirahatMulaiCarbon() &&
                            $konfigurasi->jamIstirahatSelesaiCarbon()
                                ? $konfigurasi->jamIstirahatMulaiCarbon()->format('H:i') .
                                    ' – ' .
                                    $konfigurasi->jamIstirahatSelesaiCarbon()->format('H:i')
                                : '-'" />
                        </div>
                    </x-card>

                    {{-- LOKASI & KONTAK --}}
                    <x-card title="Lokasi & Kontak" icon="heroicon-o-map">
                        <div class="space-y-4">
                            <x-info label="Koordinat" :value="$konfigurasi->kantor_lat && $konfigurasi->kantor_lng
                                ? $konfigurasi->kantor_lat . ', ' . $konfigurasi->kantor_lng
                                : '-'" />
                            <x-info label="Link Maps" :value="$konfigurasi->link_maps ? 'Klik untuk melihat maps' : '-'" :link="$konfigurasi->link_maps" />
                            <x-info label="WhatsApp*" :value="$konfigurasi->wa_link
                                ? str_replace('https://wa.me/', '', $konfigurasi->wa_link)
                                : '-'" :link="$konfigurasi->wa_link" />
                            <x-info label="Instagram" :value="$konfigurasi->ig_link ? '@' . basename($konfigurasi->ig_link) : '-'" :link="$konfigurasi->ig_link" />
                        </div>
                    </x-card>
                </div>

                {{-- ATURAN PRESENSI --}}
                <x-card>
                    <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700 -mb-2">
                        <x-heroicon-o-document-text class="w-5 h-5 text-indigo-600" />
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
                {{-- JIKA BELUM ADA DATA --}}
                <div class="text-center py-6 space-y-4">
                    <x-heroicon-o-building-office class="w-14 h-14 text-gray-300 mx-auto" />
                    <p class="text-gray-500">
                        Data konfigurasi belum ada
                    </p>

                    <x-button-link href="{{ route('admin.konfigurasi.create') }}" variant="primary"
                        icon="heroicon-o-plus-circle">
                        Buat
                    </x-button-link>
                </div>

            @endif
        </x-card>
    </div>

</x-appadmin-layout>
