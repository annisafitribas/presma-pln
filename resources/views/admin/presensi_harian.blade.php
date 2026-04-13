<x-appadmin-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h1 class="text-xl font-semibold text-[#0D1B2A]">
                Presensi Harian
            </h1>

        </div>
    </x-slot>

    <div class="space-y-6">

        <x-card class="space-y-6">

            <div class="flex items-center gap-2">
                <x-heroicon-o-calendar-days class="w-5 h-5 text-[#0D1B2A]" />
                <h3 class="font-semibold text-lg text-[#0D1B2A]">
                    Presensi Harian
                </h3>
                <span class="text-sm font-semibold text-gray-600">
                    {{ $today->format('d M Y') }}
                </span>
            </div>

            @php
                $statusMap = [
                    'hadir' => ['label' => 'Hadir', 'class' => 'bg-green-100 text-green-700'],
                    'izin' => ['label' => 'Izin', 'class' => 'bg-blue-100 text-blue-700'],
                    'sakit' => ['label' => 'Sakit', 'class' => 'bg-indigo-100 text-indigo-700'],
                    'alpha' => ['label' => 'Alpha', 'class' => 'bg-red-100 text-red-700'],
                    'telat' => ['label' => 'Terlambat', 'class' => 'bg-yellow-100 text-yellow-700'],
                    'belum_absen' => ['label' => 'Belum', 'class' => 'bg-gray-100 text-gray-600'],
                ];
            @endphp

            {{-- DESKTOP --}}
            <div class="hidden sm:block overflow-x-auto">

                <x-table class="w-full text-sm">
                    <thead>
                        <tr>
                            <x-table-th align="center" class="w-12">No</x-table-th>
                            <x-table-th>Nama</x-table-th>
                            <x-table-th>Bagian</x-table-th>
                            <x-table-th>Pembimbing</x-table-th>
                            <x-table-th align="center">Masuk</x-table-th>
                            <x-table-th align="center">Pulang</x-table-th>
                            <x-table-th align="center">Status</x-table-th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            @php
                                $p = $presensiHariIni[$user->id] ?? null;
                                $displayStatus = 'belum_absen';

                                if ($p) {
                                    $displayStatus = $p->status;

                                    if ($p->status === 'hadir' && $p->is_late) {
                                        $displayStatus = 'telat';
                                    }
                                }
                            @endphp

                            <tr class="hover:bg-[#0D1B2A1A] even:bg-[#F8FAFC] transition">

                                <x-table-td align="center">
                                    {{ $loop->iteration }}
                                </x-table-td>

                                <x-table-td class="font-semibold">
                                    {{ $user->name }}
                                </x-table-td>

                                <x-table-td>
                                    {{ optional(optional($user->profile)->bagian)->nama ?? '-' }}
                                </x-table-td>

                                <x-table-td>
                                    {{ optional(optional($user->profile)->pembimbing)->user->name ?? '-' }}
                                </x-table-td>

                                <x-table-td align="center">
                                    {{ $p?->jam_masuk ?? '-' }}
                                </x-table-td>

                                <x-table-td align="center">
                                    {{ $p?->jam_keluar ?? '-' }}
                                </x-table-td>

                                <x-table-td align="center">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $statusMap[$displayStatus]['class'] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ $statusMap[$displayStatus]['label'] ?? '-' }}
                                    </span>
                                </x-table-td>

                            </tr>
                        @endforeach
                    </tbody>
                </x-table>

            </div>


            {{-- MOBILE --}}
            <div class="sm:hidden space-y-4">

                @foreach ($users as $user)
                    @php
                        $p = $presensiHariIni[$user->id] ?? null;
                        $displayStatus = 'belum_absen';

                        if ($p) {
                            $displayStatus = $p->status;

                            if ($p->status === 'hadir' && $p->is_late) {
                                $displayStatus = 'telat';
                            }
                        }
                    @endphp

                    <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">

                        {{-- HEADER --}}
                        <div class="flex justify-between items-start mb-3">

                            <div>
                                <p class="font-semibold text-gray-800">
                                    {{ $user->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ optional(optional($user->profile)->bagian)->nama ?? '-' }}
                                </p>
                            </div>

                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $statusMap[$displayStatus]['class'] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ $statusMap[$displayStatus]['label'] ?? '-' }}
                            </span>

                        </div>

                        {{-- DETAIL --}}
                        <div class="text-sm text-gray-600 space-y-2">

                            <div class="flex justify-between">
                                <span class="text-gray-500">Jam</span>
                                <span class="text-gray-800 font-medium">
                                    {{ $p?->jam_masuk ?? '-' }} - {{ $p?->jam_keluar ?? '-' }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-500">Pembimbing</span>
                                <span class="text-gray-800 font-medium text-right">
                                    {{ optional(optional($user->profile)->pembimbing)->user->name ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-card>
    </div>
</x-appadmin-layout>
