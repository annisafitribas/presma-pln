<x-appadmin-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <h1 class="text-xl font-semibold text-[#0D1B2A]">
                Dashboard Admin
            </h1>
        </div>
    </x-slot>

    <div class="space-y-8">

        <x-card class="space-y-6">

            <h2 class="text-lg font-semibold text-[#0D1B2A]">
                Ringkasan Data Sistem
            </h2>

            {{-- DESKTOP --}}
            <div class="hidden md:flex gap-4">

                <div class="flex-1 bg-white border rounded-2xl py-6 text-center shadow-sm">
                    <p class="text-xs text-gray-500">Admin</p>
                    <p class="text-2xl font-bold text-gray-700 mt-2">
                        {{ $totalAdmin }}
                    </p>
                </div>

                <div class="flex-1 bg-white border rounded-2xl py-6 text-center shadow-sm">
                    <p class="text-xs text-gray-500">Pembimbing</p>
                    <p class="text-2xl font-bold text-gray-700 mt-2">
                        {{ $totalPembimbing }}
                    </p>
                </div>

                <div class="flex-1 bg-white border rounded-2xl py-6 text-center shadow-sm">
                    <p class="text-xs text-gray-500">Peserta</p>
                    <p class="text-2xl font-bold text-gray-700 mt-2">
                        {{ $totalPeserta }}
                    </p>
                </div>

                <div class="flex-1 bg-white border rounded-2xl py-6 text-center shadow-sm">
                    <p class="text-xs text-gray-500">Bagian</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $totalBagian }}
                    </p>
                </div>

            </div>


            {{-- MOBILE --}}
            <div class="md:hidden">
                <div class="bg-white rounded-2xl border flex divide-x text-center">

                    <div class="flex-1 py-4">
                        <p class="text-xs text-gray-500">Admin</p>
                        <p class="text-lg font-bold mt-1">
                            {{ $totalAdmin }}
                        </p>
                    </div>

                    <div class="flex-1 py-4">
                        <p class="text-xs text-gray-500">Mentor</p>
                        <p class="text-lg font-bold mt-1">
                            {{ $totalPembimbing }}
                        </p>
                    </div>

                    <div class="flex-1 py-4">
                        <p class="text-xs text-gray-500">Peserta</p>
                        <p class="text-lg font-bold mt-1">
                            {{ $totalPeserta }}
                        </p>
                    </div>

                    <div class="flex-1 py-4">
                        <p class="text-xs text-gray-500">Bagian</p>
                        <p class="text-lg font-bold mt-1">
                            {{ $totalBagian }}
                        </p>
                    </div>

                </div>
            </div>

        </x-card>

        {{-- BELUM PRESENSI --}}
        <x-card class="space-y-6">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                <h2 class="text-lg font-semibold text-[#0D1B2A]">
                    Belum Presensi
                    <span class="text-gray-500 font-medium">
                        Total: {{ $belumPresensi->count() }}
                    </span>
                </h2>

                <a href="{{ route('admin.presensi.harian') }}"
                    class="text-sm font-semibold text-blue-600 underline hover:text-blue-800">
                    Detail
                </a>

            </div>

            @if ($belumPresensi->isNotEmpty())

                <div class="overflow-x-auto">
                    <x-table class="w-full text-sm">
                        <thead>
                            <tr>
                                <x-table-th class="w-14 text-center hidden sm:table-cell">
                                    No
                                </x-table-th>
                                <x-table-th>Nama</x-table-th>
                                <x-table-th>Bagian</x-table-th>
                                <x-table-th class="hidden sm:table-cell">
                                    Pembimbing
                                </x-table-th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach ($belumPresensi as $user)
                                <tr class="hover:bg-gray-50 transition">

                                    <x-table-td class="text-center w-14 hidden sm:table-cell">
                                        {{ $loop->iteration }}
                                    </x-table-td>

                                    <x-table-td class="font-medium">
                                        {{ $user->name }}
                                    </x-table-td>

                                    <x-table-td>
                                        {{ optional(optional($user->profile)->bagian)->nama ?? '-' }}
                                    </x-table-td>

                                    <x-table-td class="hidden sm:table-cell">
                                        {{ optional(optional($user->profile)->pembimbing)->user->name ?? '-' }}
                                    </x-table-td>

                                </tr>
                            @endforeach
                        </tbody>
                    </x-table>
                </div>
            @else
                <div class="text-center py-6 text-gray-400 italic">
                    Tidak ada data peserta yang belum presensi
                </div>

            @endif

        </x-card>

    </div>

</x-appadmin-layout>
