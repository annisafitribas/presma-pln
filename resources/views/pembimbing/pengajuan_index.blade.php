<x-apppembimbing-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Daftar Pengajuan
        </h2>
    </x-slot>

    <x-card>
        <div class="text-sm flex items-center justify-between mb-4">
            <div class="text-gray-600">
                Total Pengajuan :
                <span class="font-semibold text-gray-800">
                    {{ $pengajuans->total() }}
                </span>
            </div>
        </div>


        {{-- DESKTOP TABLE --}}
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-sm table-fixed">

                <thead class="bg-gray-100 border-b">
                    <tr class="text-gray-600 text-sm">
                        <th class="px-4 py-3 text-left w-[30%]">Peserta</th>
                        <th class="px-4 py-3 text-left w-[20%]">Tanggal Pengajuan</th>
                        <th class="px-4 py-3 text-left w-[10%]">Jenis</th>
                        <th class="px-4 py-3 text-left w-[20%]">Catatan Admin</th>
                        <th class="px-4 py-3 text-center w-[10%]">Status</th>
                        <th class="px-4 py-3 text-center w-[10%]">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y bg-white">
                    @forelse($pengajuans as $item)
                        @php
                            $status = strtolower(trim($item->status));
                        @endphp

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3">
                                <p class="font-semibold text-gray-800">
                                    {{ $item->user->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $item->user->email }}
                                </p>
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap text-gray-800">
                                {{ \Carbon\Carbon::parse($item->tgl_mulai)->format('d M Y') }}
                                <span class="text-gray-400 mx-1">–</span>
                                {{ \Carbon\Carbon::parse($item->tgl_selesai)->format('d M Y') }}
                            </td>

                            <td class="px-4 py-3 text-gray-800">
                                {{ ucfirst($item->jenis ?? 'izin') }}
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                {{ $item->catatan_admin ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    @if ($status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($status === 'approved')
                                        bg-green-100 text-green-800
                                    @elseif($status === 'rejected')
                                        bg-red-100 text-red-800
                                    @else
                                        bg-gray-100 text-gray-700 @endif">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('pembimbing.pengajuan.show', $item->id) }}"
                                    class="text-blue-600 hover:underline text-sm font-semibold">
                                    Detail
                                </a>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-500">
                                Tidak ada pengajuan
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>



        {{-- MOBILE CARD --}}
        <div class="lg:hidden space-y-4">

            @forelse($pengajuans as $item)
                @php
                    $status = strtolower(trim($item->status));
                @endphp

                <div class="border rounded-xl p-5 shadow-sm bg-white">

                    {{-- HEADER --}}
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <p class="font-semibold text-gray-800">
                                {{ $item->user->name }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $item->user->email }}
                            </p>
                        </div>

                        <span
                            class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    @if ($status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($status === 'approved')
                                        bg-green-100 text-green-800
                                    @elseif($status === 'rejected')
                                        bg-red-100 text-red-800
                                    @else
                                        bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($status) }}
                        </span>
                    </div>

                    {{-- DETAIL --}}
                    <div class="flex justify-between text-sm text-gray-700 mb-3 gap-4">

                        {{-- TANGGAL --}}
                        <div>
                            <span class="text-gray-400 text-xs">Tanggal</span><br>
                            {{ \Carbon\Carbon::parse($item->tgl_mulai)->format('d M Y') }}
                            –
                            {{ \Carbon\Carbon::parse($item->tgl_selesai)->format('d M Y') }}
                        </div>

                        {{-- JENIS --}}
                        <div class="text-right">
                            <span class="text-gray-400 text-xs">Jenis</span><br>
                            {{ ucfirst($item->jenis ?? '-') }}
                        </div>

                    </div>
                    {{-- AKSI --}}
                    <a href="{{ route('pembimbing.pengajuan.show', $item->id) }}"
                        class="block text-center bg-blue-600 text-white py-2 rounded-lg text-sm font-semibold">
                        Lihat Detail
                    </a>

                </div>

            @empty
                <div class="text-center py-10 text-gray-500">
                    Tidak ada pengajuan
                </div>
            @endforelse

        </div>

        <div class="flex justify-end mt-6">
            {{ $pengajuans->onEachSide(1)->links() }}
        </div>

    </x-card>

    {{-- INFO --}}
    <x-card class="mt-6 bg-blue-50 border border-blue-100">
        <div class="flex items-start gap-3 text-sm text-blue-700">
            <x-heroicon-o-information-circle class="w-5 h-5 mt-0.5 flex-shrink-0 text-blue-600" />
            <p class="leading-relaxed">
                Pengajuan ini hanya dapat
                <span class="font-semibold text-blue-800">
                    disetujui atau ditolak oleh Admin
                </span>.
            </p>
        </div>
    </x-card>

</x-apppembimbing-layout>
