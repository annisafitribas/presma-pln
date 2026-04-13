<x-apppembimbing-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="space-y-6">

        {{-- 
            REKAP PRESENSI HARI INI
         --}}
        <x-card class="space-y-3">

            <h3 class="font-semibold text-gray-800">
                Rekap Presensi Hari Ini
            </h3>

            {{-- DESKTOP --}}
            <div class="hidden lg:grid grid-cols-6 gap-3">

                @foreach ([['Hadir', $hadir, 'text-green-600'], ['Telat', $telat, 'text-yellow-600'], ['Izin', $izin, 'text-blue-600'], ['Sakit', $sakit, 'text-purple-600'], ['Alpha', $alphaHariIni, 'text-red-600'], ['Belum', $belumPresensi, 'text-gray-700']] as [$label, $value, $color])
                    <x-card class="text-center py-3">
                        <p class="text-sm text-gray-500">
                            {{ $label }}
                        </p>
                        <p class="text-2xl font-semibold {{ $color }}">
                            {{ $value }}
                        </p>
                    </x-card>
                @endforeach

            </div>

            {{-- MOBILE --}}
            <x-card class="lg:hidden px-2 py-3">
                <div class="flex text-sm text-center divide-x">

                    <div class="flex-1">
                        <p class="text-gray-400">Hadir</p>
                        <p class="text-green-700">{{ $hadir }}</p>
                    </div>

                    <div class="flex-1">
                        <p class="text-gray-400">Telat</p>
                        <p class="text-yellow-700">{{ $telat }}</p>
                    </div>

                    <div class="flex-1">
                        <p class="text-gray-400">Izin</p>
                        <p class="text-blue-700">{{ $izin }}</p>
                    </div>

                    <div class="flex-1">
                        <p class="text-gray-400">Sakit</p>
                        <p class="text-purple-700">{{ $sakit }}</p>
                    </div>

                    <div class="flex-1">
                        <p class="text-gray-400">Alpha</p>
                        <p class="text-red-700">{{ $alphaHariIni }}</p>
                    </div>

                    <div class="flex-1">
                        <p class="text-gray-400">Belum</p>
                        <p class="text-gray-700">{{ $belumPresensi }}</p>
                    </div>

                </div>
            </x-card>

        </x-card>



        {{-- 
            PRESENSI HARI INI
         --}}
        <x-card>

            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-800">
                    Presensi Hari Ini
                </h3>

                <span class="text-sm font-semibold text-gray-600">
                    Total Peserta: {{ $peserta->count() }}
                </span>
            </div>


            {{-- DESKTOP TABLE --}}
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full table-fixed text-sm">

                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-4 py-2 text-center w-[50px]">No</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-center">Masuk</th>
                            <th class="px-4 py-2 text-center">Keluar</th>
                            <th class="px-4 py-2 text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($peserta as $index => $user)
                            @php
                                $pHariIni = $presensiHariIni[$user->id] ?? null;
                            @endphp

                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-4 py-2 text-center font-medium text-gray-600">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-4 py-2 font-semibold text-gray-800">
                                    {{ $user->name }}
                                </td>

                                <td class="px-4 py-2 text-center">
                                    {{ $pHariIni?->jam_masuk ?? '-' }}
                                </td>

                                <td class="px-4 py-2 text-center">
                                    {{ $pHariIni?->jam_keluar ?? '-' }}
                                </td>

                                <td class="px-4 py-2 text-center">

                                    @if (!$pHariIni)
                                        <span class="px-3 py-1 text-sm rounded-full bg-gray-200 text-gray-700">
                                            Belum Presensi
                                        </span>
                                    @elseif($pHariIni->status === 'izin')
                                        <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-700">
                                            Izin
                                        </span>
                                    @elseif($pHariIni->status === 'sakit')
                                        <span class="px-3 py-1 text-sm rounded-full bg-purple-100 text-purple-700">
                                            Sakit
                                        </span>
                                    @elseif($pHariIni->status === 'alpha')
                                        <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-700">
                                            Alpha
                                        </span>
                                    @elseif($pHariIni->status === 'hadir' && $pHariIni->is_late)
                                        <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">
                                            Telat
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                                            Hadir
                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500">
                                    Tidak ada data peserta
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

            {{-- MOBILE CARD --}}
            <div class="lg:hidden space-y-3">

                @forelse($peserta as $index => $user)
                    @php
                        $pHariIni = $presensiHariIni[$user->id] ?? null;
                    @endphp

                    <div class="border rounded-xl px-4 py-3 shadow-sm bg-white">

                        {{-- BARIS 1 --}}
                        <div class="flex justify-between items-center mb-1">

                            <p class="font-semibold text-gray-800 text-sm">
                                {{ $user->name }}
                            </p>

                            @if (!$pHariIni)
                                <span class="text-gray-500 text-sm">Belum</span>
                            @elseif($pHariIni->status === 'izin')
                                <span class="text-blue-600 text-sm font-semibold">Izin</span>
                            @elseif($pHariIni->status === 'sakit')
                                <span class="text-purple-600 text-sm font-semibold">Sakit</span>
                            @elseif($pHariIni->status === 'alpha')
                                <span class="text-red-600 text-sm font-semibold">Alpha</span>
                            @elseif($pHariIni->status === 'hadir' && $pHariIni->is_late)
                                <span class="text-yellow-600 text-sm font-semibold">Telat</span>
                            @else
                                <span class="text-green-600 text-sm font-semibold">Hadir</span>
                            @endif

                        </div>

                        {{-- BARIS 2 --}}
                        <p class="text-sm text-gray-600">
                            {{ $pHariIni?->jam_masuk ?? '-' }}
                            -
                            {{ $pHariIni?->jam_keluar ?? '-' }}
                        </p>

                    </div>

                @empty
                    <div class="text-center py-6 text-gray-500">
                        Tidak ada data
                    </div>
                @endforelse

            </div>

        </x-card>

    </div>

</x-apppembimbing-layout>
