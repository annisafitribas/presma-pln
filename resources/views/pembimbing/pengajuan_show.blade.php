<x-apppembimbing-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold text-[#0D1B2A]">
                Detail Pengajuan
            </h2>
        </div>
    </x-slot>

    <div class="space-y-6 mb-6">

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- DATA PESERTA --}}
            <x-card class="space-y-4">
                <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                    <x-heroicon-o-user class="w-5 h-5 text-blue-600" />
                    Data Peserta
                </h3>

                <div class="space-y-4 text-sm">

                    <div>
                        <p class="text-gray-500 text-sm">Nama</p>
                        <p class="font-semibold text-gray-800">
                            {{ $pengajuan->user->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Email</p>
                        <p class="text-gray-800">
                            {{ $pengajuan->user->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Bagian</p>
                        <p class="text-gray-800">
                            {{ $pengajuan->user->profile?->bagian?->nama ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Status Magang</p>
                        <p class="text-gray-800">
                            {{ $pengajuan->user->profile?->status_magang ?? '-' }}
                        </p>
                    </div>

                </div>
            </x-card>



            {{-- DETAIL PENGAJUAN --}}
            <x-card class="space-y-4">
                <div class="flex justify-between items-start">

                    <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                        <x-heroicon-o-document-text class="w-5 h-5 text-blue-600" />
                        Detail Pengajuan
                    </h3>

                    <div class="text-right text-sm">
                        <p class="text-gray-800">
                            {{ \Carbon\Carbon::parse($pengajuan->tgl_mulai)->format('d M Y') }}
                            –
                            {{ \Carbon\Carbon::parse($pengajuan->tgl_selesai)->format('d M Y') }}
                        </p>
                    </div>

                </div>

                <div class="space-y-4 text-sm">

                    <div class="flex justify-between gap-4">
                        <div>
                            <p class="text-gray-500 text-xs">Jenis</p>
                            <p class="text-gray-800">
                                {{ ucfirst($pengajuan->jenis ?? '-') }}
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-gray-500 text-xs">Status</p>
                            <span class="text-sm font-semibold
                                @class([
                                    'text-yellow-700' => $pengajuan->status === 'pending',
                                    'text-green-700' => $pengajuan->status === 'approved',
                                    'text-red-700' => $pengajuan->status === 'rejected',
                                ])">
                                {{ ucfirst($pengajuan->status) }}
                            </span>
                        </div>
                    </div>

                    {{-- KETERANGAN --}}
                    <div>
                        <p class="text-gray-500 text-xs">Keterangan</p>
                        <p class="text-gray-800">
                            {{ $pengajuan->keterangan ?? '-' }}
                        </p>
                    </div>

                    {{-- CATATAN ADMIN --}}
                    <div>
                        <p class="text-gray-500 text-xs">Catatan Admin</p>
                        <p class="text-gray-800">
                            {{ $pengajuan->catatan_admin ?? '-' }}
                        </p>
                    </div>

                    {{-- DOKUMEN --}}
                    <div>
                        <p class="text-gray-500 text-xs">Dokumen</p>
                        @if ($pengajuan->bukti)
                            <a href="{{ asset('storage/' . $pengajuan->bukti) }}" target="_blank"
                                class="inline-flex items-center gap-1 text-blue-600 hover:underline font-semibold">
                                <x-heroicon-o-document-arrow-down class="w-4 h-4" />
                                Lihat Dokumen
                            </a>
                        @else
                            <p class="text-gray-400">-</p>
                        @endif
                    </div>

                </div>
            </x-card>

        </div>

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

    </div>

</x-apppembimbing-layout>
