<x-appuser-layout>

    <x-slot name="header">
        <span class="font-semibold text-[#0D1B2A]">Dashboard</span>
    </x-slot>
    <div class="space-y-4 mb-6">

        {{-- WELCOME --}}
        <div
            class="bg-gradient-to-r from-[#0F2F57] via-[#123B6E] to-[#1E4F8F] text-white p-6 rounded-xl shadow space-y-3">

            <h2 class="text-xl font-semibold flex items-center gap-2">
                <x-heroicon-o-hand-raised class="w-6 h-6" />
                Halo, {{ $user->name }}
            </h2>

            <p class="text-sm opacity-90">
                Peserta Magang di {{ $konfigurasi?->nama_pt ?? 'Perusahaan' }}
            </p>
        </div>

        @php
            $aktif = $user->profile?->status_magang === 'Aktif';
            $hariKerjaFinal = $konfigurasi->isHariKerjaFinal();
            $isHariKerja = $konfigurasi->isHariKerja();
            $isHariLibur = $konfigurasi->isHariLibur();
        @endphp
        @if (session('auto_alpha'))
            <div class="mb-4 rounded-xl border border-orange-300 bg-orange-50 p-6 text-sm text-orange-800 shadow">
                <div class="font-semibold mb-1 flex items-center gap-2">
                    Informasi Sistem
                </div>
                <div>
                    {{ session('auto_alpha') }}
                </div>
            </div>
        @endif

        @if (isset($presensiHariIni) && $presensiHariIni?->status === 'alpha')
            <div class="mb-4 rounded-xl border border-red-300 bg-red-50 p-6 text-sm text-red-800 shadow">
                <div class="font-semibold mb-1 flex items-center gap-2">
                    Status kehadiran hari ini
                </div>
                <div>
                    {{ $presensiHariIni->keterangan ?? 'Anda tercatat tidak hadir hari ini.' }}
                </div>
            </div>
        @endif

        @if (!$aktif)

            <div class="bg-red-50 border border-red-300 rounded-xl p-6 shadow space-y-3">

                <div class="flex items-center gap-3 text-red-600 font-semibold text-lg">
                    <x-heroicon-o-lock-closed class="w-7 h-7" />
                    Status Magang Tidak Aktif
                </div>

                <p class="text-sm text-red-500">
                    Presensi tidak tersedia karena masa magang telah berakhir.
                </p>

            </div>
        @elseif (!$hariKerjaFinal)
            <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-6 shadow space-y-3">

                <div class="flex items-center gap-3 text-yellow-700 font-semibold text-lg">
                    <x-heroicon-o-calendar class="w-7 h-7" />
                    Hari Ini Tidak Ada Presensi
                </div>

                <ul class="list-disc list-inside text-sm text-yellow-700 space-y-1">

                    @if (!$isHariKerja)
                        <li>Bukan hari kerja sesuai jadwal kantor.</li>
                    @endif

                    @if ($isHariLibur)
                        <li>
                            Hari libur nasional:
                            <b>{{ $konfigurasi->hariLiburDetail()?->nama ?? 'Tanggal Merah' }}</b>
                        </li>
                    @endif

                </ul>

            </div>
        @else
            {{-- TELAT PENDING --}}
            @if ($telatPending)
                <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4 text-sm text-yellow-900 space-y-1">

                    <p class="font-semibold flex items-center gap-2">
                        <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-yellow-600" />
                        Presensi Masuk Menunggu Approval
                    </p>

                    <p>
                        Presensi masuk pukul <b>{{ $telatPending->jam_masuk }}</b>, menunggu approval admin.
                    </p>
                    <p>
                        Alasan terlambat "{{ $telatPending->alasan }}"
                    </p>
                    @if ($adminWa && $telatPending)
                        @php
                            $pesan =
                                "Halo Admin

Saya ingin konfirmasi presensi telat saya.
Nama      : {$user->name}
Tanggal   : " .
                                \Carbon\Carbon::parse($telatPending->tanggal)->format('d-m-Y') .
                                "
Jam Masuk : {$telatPending->jam_masuk}

Mohon bantuannya untuk approval ya
Terima kasih.";
                        @endphp

                        <a href="https://wa.me/{{ $adminWa }}?text={{ urlencode($pesan) }}" target="_blank"
                            class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 px-42 rounded-lg text-sm font-semibold w-fit">

                            <x-heroicon-o-chat-bubble-left-right class="w-4 h-4" />
                            Hubungi Admin via WhatsApp
                        </a>
                    @endif


                </div>
            @endif

            {{-- JAM MASUK & KELUAR --}}
            <div class="bg-white p-4 rounded-xl shadow flex min-h-[96px]">

                <div class="w-1/2 flex flex-col items-center justify-center border-r">
                    <p class="text-sm text-gray-500">Jam Masuk</p>
                    <p class="font-bold text-lg text-[#123B6E]">
                        {{ $jamMasuk }}
                    </p>
                </div>

                <div class="w-1/2 flex flex-col items-center justify-center">
                    <p class="text-sm text-gray-500">Jam Keluar</p>
                    <p class="font-bold text-lg text-[#123B6E]">
                        {{ $jamKeluar }}
                    </p>
                </div>

            </div>


            {{-- STATUS & AKSI --}}
            <div class="flex rounded-xl shadow overflow-hidden">

                <div class="flex-1 p-4 flex flex-col items-center justify-center text-center bg-[#123B6E]/10">
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="font-bold mt-1 text-[#123B6E]">
                        @if ($presensiHariIni?->status)
                            {{ ucfirst(str_replace('_', ' ', $presensiHariIni->status)) }}
                        @else
                            Belum
                        @endif
                    </p>
                </div>

                <div class="flex-1 p-4 flex items-center justify-center bg-[#123B6E]/5">

                    @if (is_null($presensiHariIni))
                        {{-- BELUM PRESENSI --}}
                        <a href="{{ route('user.presensi.create') }}"
                            class="flex items-center gap-1 bg-[#123B6E] hover:bg-[#0F2F57] text-white px-6 py-2 rounded-lg font-semibold">
                            <x-heroicon-o-arrow-right-circle class="w-5 h-5" />
                            Input
                        </a>
                    @elseif (!is_null($presensiHariIni->jam_keluar))
                        {{-- SUDAH SELESAI --}}
                        <div class="flex flex-col items-center gap-1 text-[#123B6E] font-semibold">
                            <x-heroicon-o-check-circle class="w-6 h-6" />
                            <span class="text-sm">Selesai</span>
                        </div>
                    @elseif (!is_null($presensiHariIni->jam_masuk) && is_null($presensiHariIni->jam_keluar))
                        {{-- SUDAH MASUK / TELAT PENDING --}}
                        <a href="{{ route('user.presensi.create') }}"
                            class="flex items-center gap-1 bg-[#123B6E] hover:bg-[#0F2F57] text-white px-4 py-2 rounded-lg font-semibold">
                            <x-heroicon-o-clock class="w-5 h-5" />
                            Keluar
                        </a>
                    @else
                        {{-- STATUS IZIN / SAKIT / ALPHA --}}
                        <div class="flex flex-col items-center gap-1 text-[#123B6E] font-semibold">
                            <x-heroicon-o-check-circle class="w-6 h-6" />
                            <span class="text-sm">Selesai</span>
                        </div>
                    @endif
                </div>
            </div>
        @endif
        <div class="bg-white p-4 rounded-xl shadow flex">
            <div class="w-1/2 flex flex-col items-center justify-center border-r">
                <p class="text-sm text-gray-500">Hadir</p>
                <p class="font-bold text-lg text-[#123B6E]">
                    {{ $rekap->hadir ?? 0 }}
                </p>
            </div>

            <div class="w-1/2 flex flex-col items-center justify-center">
                <p class="text-sm text-gray-500">Absen</p>
                <p class="font-bold text-lg text-red-600">
                    {{ $rekap->alpha ?? 0 }}
                </p>
            </div>

        </div>

        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-[#123B6E]/40">

            {{-- MOBILE --}}
            <div class="flex flex-col gap-3 sm:hidden text-sm">

                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Status</span>
                    <span class="font-semibold text-[#123B6E]">
                        {{ $user->profile?->status_magang ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Periode</span>
                    <span class="font-semibold text-[#123B6E] text-right">
                        {{ $user->profile?->tgl_masuk?->format('d-m-Y') ?? '-' }}
                        s/d
                        {{ $user->profile?->tgl_keluar?->format('d-m-Y') ?? '-' }}
                    </span>
                </div>

            </div>

            {{-- DESKTOP --}}
            <div class="hidden sm:flex gap-4 text-sm">

                <div class="flex-1 flex flex-col items-center">
                    <p class="text-gray-500">Status Magang</p>
                    <p class="font-bold text-[#123B6E] text-lg">
                        {{ $user->profile?->status_magang ?? '-' }}
                    </p>
                </div>

                <div class="flex-1 flex flex-col items-center">
                    <p class="text-gray-500">Tanggal Mulai</p>
                    <p class="font-bold text-[#123B6E] text-lg">
                        {{ $user->profile?->tgl_masuk?->format('d-m-Y') ?? '-' }}
                    </p>
                </div>

                <div class="flex-1 flex flex-col items-center">
                    <p class="text-gray-500">Tanggal Selesai</p>
                    <p class="font-bold text-[#123B6E] text-lg">
                        {{ $user->profile?->tgl_keluar?->format('d-m-Y') ?? '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-appuser-layout>
