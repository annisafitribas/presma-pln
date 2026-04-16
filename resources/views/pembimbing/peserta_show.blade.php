<x-apppembimbing-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <span class="font-semibold text-[#0D1B2A]">
                Detail Peserta
            </span>
        </div>
    </x-slot>

    <div class="space-y-6 mb-6">

        {{--  PROFIL  --}}
        <x-card class="space-y-6">

            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-blue-100 shadow 
                        flex items-center justify-center bg-blue-100">
                @if ($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}"
                        class="w-full h-full object-cover">
                @else
                    <x-heroicon-o-user class="w-10 h-10 text-white" />
                @endif
            </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $user->name }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        {{ $user->email }}
                    </p>
                </div>
            </div>

            {{-- DATA PRIBADI --}}
            <div class="border-t pt-5 space-y-4">
                <h4 class="flex items-center gap-2 font-semibold text-gray-700">
                    <x-heroicon-o-user-circle class="w-5 h-5 text-blue-600" />
                    Data Pribadi & Magang
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <x-show-item label="Bidang" :value="$user->profile?->bidang?->nama ?? '-'" />
                    <x-show-item label="Status Magang" :value="$user->profile?->status_magang ?? '-'" />
                    <x-show-item 
                        label="Jenis Kelamin" 
                        :value="$user->gender === 'L' 
                            ? 'Laki-laki' 
                            : ($user->gender === 'P' ? 'Perempuan' : '-')" 
                    />
                    <x-show-item label="Periode" :value="$user->profile?->tgl_masuk
                        ? optional($user->profile->tgl_masuk)->format('d M Y') .
                            ' - ' .
                            ($user->profile->tgl_keluar
                                ? optional($user->profile->tgl_keluar)->format('d M Y')
                                : 'Sekarang')
                        : '-'" />
                </div>
            </div>

            {{-- DATA AKADEMIK --}}
            <div class="border-t pt-5 space-y-4">
                <h4 class="flex items-center gap-2 font-semibold text-gray-700">
                    <x-heroicon-o-academic-cap class="w-5 h-5 text-blue-600" />
                    Data Akademik
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <x-show-item label="Pendidikan" :value="$user->profile?->pendidikan ?? '-'" />
                    <x-show-item label="Jurusan" :value="$user->profile?->jurusan ?? '-'" />
                    <x-show-item label="Kelas/Semester" :value="$user->profile?->kelas ?? '-'" />
                    <x-show-item label="Nomor Induk" :value="$user->profile?->nomor_induk ?? '-'" />
                </div>
            </div>

        </x-card>



        {{--  REKAP  --}}
        <x-card class="space-y-3">
            <h3 class="font-semibold text-gray-800">
                Rekap Presensi Selama Magang
            </h3>

            {{-- DESKTOP --}}
            <div class="hidden lg:grid grid-cols-5 gap-3">
                @foreach ([['Hadir', $hadir, 'text-green-600'], ['Telat', $telat, 'text-orange-500'], ['Izin', $izin, 'text-yellow-600'], ['Sakit', $sakit, 'text-red-600'], ['Alpha', $alpha, 'text-gray-700']] as [$label, $value, $colorClass])
                    <x-card class="text-center py-2 px-2">
                        <p class="text-sm text-gray-500 leading-none">{{ $label }}</p>
                        <p class="text-2xl font-semibold {{ $colorClass }}">{{ $value }}</p>
                    </x-card>
                @endforeach
            </div>

            {{-- MOBILE --}}
            <x-card class="lg:hidden px-2 py-3">
                <div class="flex text-sm font-semibold text-center divide-x">
                    <div class="flex-1">
                        <p class="text-gray-400">Hadir</p>
                        <p class="text-green-700">{{ $hadir }}</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-400">Telat</p>
                        <p class="text-orange-700">{{ $telat }}</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-400">Izin</p>
                        <p class="text-yellow-700">{{ $izin }}</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-400">Sakit</p>
                        <p class="text-red-700">{{ $sakit }}</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-400">Alpha</p>
                        <p class="text-gray-700">{{ $alpha }}</p>
                    </div>
                </div>
            </x-card>
        </x-card>



        {{--  RIWAYAT PRESENSI  --}}
        <x-card class="space-y-4">

            <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                <x-heroicon-o-calendar-days class="w-5 h-5 text-blue-600" />
                Riwayat Presensi
            </h3>

            {{-- DESKTOP --}}
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full table-fixed text-sm">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-4 py-2 text-center w-[40px]">No</th>
                            <th class="px-4 py-2 text-left w-[130px]">Tanggal</th>
                            <th class="px-4 py-2 text-center w-[100px]">Masuk</th>
                            <th class="px-4 py-2 text-center w-[100px]">Keluar</th>
                            <th class="px-4 py-2 text-center w-[120px]">Status</th>
                            <th class="px-4 py-2 text-left w-[360px]">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($presensi as $index => $p)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-center">{{ ($presensi->currentPage() - 1) * $presensi->perPage() + $loop->iteration }}</td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-2 text-center">{{ $p->jam_masuk ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">{{ $p->jam_keluar ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">
                                    <span
                                        class="px-2 py-1 rounded-full text-sm font-semibold
                                        @class([
                                            'bg-green-100 text-green-700' => $p->status === 'hadir',
                                            'bg-orange-100 text-orange-700' => $p->status === 'telat',
                                            'bg-yellow-100 text-yellow-700' => $p->status === 'izin',
                                            'bg-red-100 text-red-700' => $p->status === 'sakit',
                                            'bg-gray-200 text-gray-700' => $p->status === 'alpha',
                                        ])">
                                        {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-left align-top">
                                    @php
                                        $keterangan = $p->keterangan ?? '';
                                        $isLong = \Illuminate\Support\Str::length($keterangan) > 60;
                                    @endphp

                                    @if (!empty($keterangan))
                                        @if ($isLong)
                                            <div x-data="{ open: false }" class="relative w-full">

                                                <div class="pr-16 text-gray-700 break-words"
                                                    :class="open ? 'whitespace-pre-line' : 'truncate'">
                                                    {{ $keterangan }}
                                                </div>

                                                <button type="button" @click="open = !open"
                                                    class="absolute right-0 top-0 text-sm text-blue-600 hover:underline">
                                                    <span x-show="!open">Detail</span>
                                                    <span x-show="open">Tutup</span>
                                                </button>

                                            </div>
                                        @else
                                            <div class="text-gray-700 break-words">
                                                {{ $keterangan }}
                                            </div>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-gray-500">
                                    Belum ada data presensi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MOBILE --}}
            <div class="md:hidden space-y-3 pb-4 text-xs">

                @forelse ($presensi as $item)
                    @php
                        $displayStatus = $item->status === 'hadir' && $item->is_late ? 'telat' : $item->status;

                        $statusMap = [
                            'hadir' => 'text-green-700',
                            'telat' => 'text-yellow-700',
                            'izin' => 'text-blue-700',
                            'sakit' => 'text-purple-700',
                            'alpha' => 'text-red-700',
                        ];

                        $statusLabel = [
                            'hadir' => 'Hadir',
                            'telat' => 'Telat',
                            'izin' => 'Izin',
                            'sakit' => 'Sakit',
                            'alpha' => 'Alpha',
                        ];
                    @endphp

                    <div class="bg-white border rounded-2xl p-4 shadow-sm" x-data="{ open: false }">

                        {{-- HEADER --}}
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-sm font-semibold text-gray-800">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                            </p>

                            <span
                                class="px-2 py-1 rounded-full text-sm font-semibold
                    {{ $statusMap[$displayStatus] ?? '' }}">
                                {{ $statusLabel[$displayStatus] ?? '-' }}
                            </span>
                        </div>

                        {{-- JAM --}}
                        <p class="text-sm text-gray-600 mb-2">
                            {{ $item->jam_masuk ?? '-' }} -
                            {{ $item->jam_keluar ?? '-' }}
                        </p>

                        {{-- KETERANGAN --}}
                        @php
                            $isLong = \Illuminate\Support\Str::length($item->keterangan ?? '') > 60;
                        @endphp

                        @if (!empty($item->keterangan))
                            <div class="border-t pt-3">

                                @if ($isLong)
                                    <div x-data="{ open: false }" class="flex justify-between items-start gap-2">

                                        <div class="flex-1 min-w-0">
                                            <p x-show="!open" class="truncate text-sm text-gray-700">
                                                {{ $item->keterangan }}
                                            </p>

                                            <p x-show="open" x-transition
                                                class="whitespace-pre-line text-sm text-gray-700">
                                                {{ $item->keterangan }}
                                            </p>
                                        </div>

                                        <button type="button" @click="open = !open"
                                            class="text-sm text-blue-600 hover:underline whitespace-nowrap">
                                            <span x-show="!open">Detail</span>
                                            <span x-show="open">Tutup</span>
                                        </button>

                                    </div>
                                @else
                                    <p class="text-sm text-gray-700">
                                        {{ $item->keterangan }}
                                    </p>
                                @endif

                            </div>
                        @endif


                    </div>

                @empty
                    <div class="text-center text-gray-500 py-10">
                        Belum ada data presensi
                    </div>
                @endforelse

            </div>

            <div class="flex justify-end mt-6">
                {{ $presensi->onEachSide(1)->links() }}
            </div>

        </x-card>

    </div>

</x-apppembimbing-layout>
