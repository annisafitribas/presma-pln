<x-appadmin-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <span class="font-semibold text-[#0D1B2A]">
                Riwayat Presensi
            </span>
        </div>
    </x-slot>

    <div class="container mx-auto">
        <x-card>

            {{-- HEADER --}}
            <div class="flex items-center gap-2 mb-4">
                <x-heroicon-o-archive-box class="w-6 h-6 text-[#0D1B2A]" />
                <h2 class="text-lg font-semibold text-[#0D1B2A]">
                    Riwayat Presensi Peserta
                </h2>
            </div>

            @if ($users->count())

                {{-- DESKTOP --}}
                <div class="hidden md:block">
                    <div class="-mx-6 overflow-x-auto">
                        <div class="min-w-[800px] px-6">

                            <x-table class="text-sm w-full">
                                <thead>
                                    <tr>
                                        <x-table-th align="center" class="w-12 whitespace-nowrap">No</x-table-th>
                                        <x-table-th>Nama</x-table-th>
                                        <x-table-th align="center" class="w-28">Hadir</x-table-th>
                                        <x-table-th align="center" class="w-28">Telat</x-table-th>
                                        <x-table-th align="center" class="w-28">Sakit</x-table-th>
                                        <x-table-th align="center" class="w-28">Izin</x-table-th>
                                        <x-table-th align="center" class="w-28">Alpha</x-table-th>
                                        <x-table-th align="center" class="w-28">Pending</x-table-th>
                                        <x-table-th align="center">Aksi</x-table-th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="hover:bg-[#0D1B2A1A] even:bg-[#F8FAFC] transition">

                                            <x-table-td align="center">
                                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                            </x-table-td>

                                            <x-table-td>
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold">
                                                        {{ $user->name }}
                                                    </span>

                                                    @php
                                                        $status = optional($user->profile)->status_magang;
                                                    @endphp

                                                    @if ($status === 'Aktif')
                                                        <span
                                                            class="px-2 py-[4px] text-[10px] leading-none rounded-full bg-green-100 text-green-700 font-semibold">
                                                            Aktif
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-2 py-[4px] text-[10px] leading-none rounded-full bg-red-100 text-red-700 font-semibold">
                                                            Tidak Aktif
                                                        </span>
                                                    @endif
                                                </div>
                                            </x-table-td>

                                            <x-table-td align="center">{{ $user->total_hadir }}</x-table-td>
                                            <x-table-td align="center">{{ $user->total_telat }}</x-table-td>
                                            <x-table-td align="center">{{ $user->total_sakit }}</x-table-td>
                                            <x-table-td align="center">{{ $user->total_izin }}</x-table-td>
                                            <x-table-td align="center">{{ $user->total_alpha }}</x-table-td>
                                            <x-table-td align="center">{{ $user->total_pending }}</x-table-td>

                                            <x-table-td align="center">
                                                <a href="{{ route('admin.presensi.show', $user->id) }}"
                                                    class="text-blue-600 hover:underline text-sm font-semibold">
                                                    Detail
                                                </a>
                                            </x-table-td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </x-table>

                        </div>
                    </div>
                </div>

                {{-- MOBILE --}}
                <div class="md:hidden space-y-4">

                    @foreach ($users as $user)
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">

                            {{-- HEADER --}}
                            <div class="flex items-center justify-between mb-4">

                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="font-semibold text-[#0D1B2A] text-sm">
                                            {{ $user->name }}
                                        </p>

                                        @php
                                            $status = optional($user->profile)->status_magang;
                                        @endphp

                                        @if ($status === 'Aktif')
                                            <span
                                                class="px-2 py-0.5 text-[10px] rounded-full bg-green-100 text-green-700 font-semibold">
                                                Aktif
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-0.5 text-[10px] rounded-full bg-red-100 text-red-700 font-semibold">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-400">
                                        {{ optional(optional($user->profile)->bidang)->nama ?? '-' }}
                                    </p>
                                </div>

                                <a href="{{ route('admin.presensi.show', $user->id) }}"
                                    class="text-blue-600 hover:underline text-sm font-semibold">
                                    Detail
                                </a>

                            </div>

                            {{-- STAT GRID --}}
                            <div class="grid grid-cols-6 text-center border-t border-gray-200 pt-3">

                                <div>
                                    <p class="text-gray-400 text-[11px]">Hadir</p>
                                    <p class="font-semibold text-gray-800">
                                        {{ $user->total_hadir }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-[11px]">Telat</p>
                                    <p class="font-semibold text-gray-800">
                                        {{ $user->total_telat }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-[11px]">Sakit</p>
                                    <p class="font-semibold text-gray-800">
                                        {{ $user->total_sakit }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-[11px]">Izin</p>
                                    <p class="font-semibold text-gray-800">
                                        {{ $user->total_izin }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-[11px]">Alpha</p>
                                    <p class="font-semibold text-gray-800">
                                        {{ $user->total_alpha }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-[11px]">Pending</p>
                                    <p class="font-semibold text-yellow-600">
                                        {{ $user->total_pending }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>

                <div class="flex justify-end mt-6 px-6">
                    {{ $users->onEachSide(1)->links() }}
                </div>
            @else
                <div class="text-center font-semibold py-10 flex flex-col items-center gap-2">
                    <x-heroicon-o-folder-minus class="w-12 h-12 text-[#CBD5E1]" />
                    <span>Belum ada data presensi</span>
                </div>

            @endif

        </x-card>
    </div>

</x-appadmin-layout>
