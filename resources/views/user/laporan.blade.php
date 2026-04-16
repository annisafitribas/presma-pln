<x-appuser-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <span class="font-semibold text-[#0D1B2A]">
            Laporan Presensi
        </span>
    </x-slot>

    {{-- TOAST --}}
    <x-user-toast />
    @if (session('success'))
        <script>
            window.addEventListener('load', () => {
                window.dispatchEvent(new CustomEvent('user-toast', {
                    detail: {
                        title: 'Berhasil',
                        message: @json(session('success'))
                    }
                }));
            });
        </script>
    @endif


    @if (session('error'))
        <script>
            window.addEventListener('load', () => {
                window.dispatchEvent(new CustomEvent('user-toast', {
                    detail: {
                        title: 'Gagal',
                        message: @json(session('error'))
                    }
                }));
            });
        </script>
    @endif
    @if (session('download_file'))
        <script>
            window.addEventListener('load', () => {
                window.location.href = "{{ asset('storage/' . session('download_file')) }}";
            });
        </script>
    @endif

    <iframe name="downloadFrame" style="display:none;"></iframe>

    <div x-data="{ openExport: false }">

        @php
            $hadir = $presensi->where('status', 'hadir')->where('is_late', false)->count();
            $pending = $presensi->where('status', 'pending')->count();
            $telat = $presensi->where('status', 'hadir')->where('is_late', true)->count();
            $sakit = $presensi->where('status', 'sakit')->count();
            $izin = $presensi->where('status', 'izin')->count();
            $alpha = $presensi->where('status', 'alpha')->count();
        @endphp

        {{-- REKAP (DESKTOP) --}}
        <div class="hidden md:grid grid-cols-5 gap-4 mb-4">
            <x-card class="text-center">
                <p class="text-sm text-gray-500">Hadir</p>
                <p class="text-2xl font-bold text-green-600">{{ $hadir }}</p>
            </x-card>

            <x-card class="text-center">
                <p class="text-sm text-gray-500">Telat</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $telat }}</p>
            </x-card>

            <x-card class="text-center">
                <p class="text-sm text-gray-500">Sakit</p>
                <p class="text-2xl font-bold text-purple-600">{{ $sakit }}</p>
            </x-card>

            <x-card class="text-center">
                <p class="text-sm text-gray-500">Izin</p>
                <p class="text-2xl font-bold text-blue-600">{{ $izin }}</p>
            </x-card>

            <x-card class="text-center">
                <p class="text-sm text-gray-500">Alpha</p>
                <p class="text-2xl font-bold text-red-600">{{ $alpha }}</p>
            </x-card>
        </div>

        {{-- MOBILE --}}
        <x-card class="md:hidden px-2 py-3 mb-6">

            @php
                $rekapMobile = [
                    'Hadir' => $hadir,
                    'Pending' => $pending,
                    'Telat' => $telat,
                    'Sakit' => $sakit,
                    'Izin' => $izin,
                    'Alpha' => $alpha,
                ];
            @endphp

            <div class="flex text-xs font-semibold text-center divide-x">
                @foreach ($rekapMobile as $label => $value)
                    <div class="flex-1">
                        <p class="text-gray-400">{{ $label }}</p>
                        <p class="text-[#123B6E] text-sm font-bold">
                            {{ $value }}
                        </p>
                    </div>
                @endforeach
            </div>

        </x-card>

        <x-card class="p-0 overflow-hidden mb-6">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">

                {{-- TITLE --}}
                <div class="flex items-center gap-2 text-[#123B6E] font-semibold text-lg">
                    <x-heroicon-o-clipboard-document-list class="w-5 h-5" />
                    <span>Riwayat Presensi</span>
                </div>

                {{-- ACTIONS --}}
                <div class="flex gap-3 w-full md:w-auto">

                    {{-- SORT --}}
                    <form method="GET" class="w-1/2 md:w-40">
                        <x-select-box name="sort" :value="request('sort', 'desc')" :options="[
                            'desc' => 'Terbaru',
                            'asc' => 'Terlama',
                        ]" placeholder="Urutkan"
                            submit="true" />
                    </form>

                    {{-- EXPORT --}}
                    <x-user-button icon="heroicon-o-arrow-down-tray"
                        x-on:click="$dispatch('open-modal', 'export-presensi')" class="w-1/2 md:w-auto justify-center">
                        Export
                    </x-user-button>

                </div>

            </div>

            <div class="mt-6">

                {{-- MOBILE CARD --}}
                <div class="md:hidden space-y-3 pb-3">

                    @forelse ($presensi as $i => $item)
                        @php
                            $displayStatus = $item->status === 'hadir' && $item->is_late ? 'telat' : $item->status;

                            $statusMap = [
                                'hadir' => 'text-green-600',
                                'pending' => 'text-gray-500 italic',
                                'telat' => 'text-yellow-600',
                                'izin' => 'text-blue-600',
                                'sakit' => 'text-purple-600',
                                'alpha' => 'text-red-600',
                            ];

                            $statusLabel = [
                                'hadir' => 'Hadir',
                                'pending' => 'Pending',
                                'telat' => 'Telat',
                                'izin' => 'Izin',
                                'sakit' => 'Sakit',
                                'alpha' => 'Alpha',
                            ];

                            $jamMasuk = $item->jam_masuk ?? '-';
                            $jamKeluar = $item->jam_keluar ?? '-';
                        @endphp

                        <div class="bg-white border border-gray-200 rounded-2xl p-3 shadow-sm" x-data="{ open: false }">

                            {{-- BARIS 1 : TANGGAL + STATUS --}}
                            <div class="flex justify-between items-center">

                                <div class="flex items-center gap-1.5">

                                    <div class="text-sm font-semibold text-gray-800">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </div>

                                    <span class="ml-2 text-sm {{ $statusMap[$displayStatus] ?? 'text-gray-400' }}">

                                        {{ $statusLabel[$displayStatus] ?? 'Pending' }}

                                        @if ($displayStatus === 'telat' && $item->late_minutes)
                                            <span class="ml-1 text-[11px]">
                                                ({{ $item->late_minutes }} menit)
                                            </span>
                                        @endif

                                    </span>

                                </div>

                                {{-- DETAIL BUTTON --}}
                                <button type="button" @click="open = !open"
                                    class="text-xs text-[#123B6E] hover:underline">
                                    <span x-show="!open">Detail</span>
                                    <span x-show="open">Tutup</span>
                                </button>

                            </div>

                            {{-- DETAIL AREA --}}
                            <div x-show="open" x-transition class="mt-1 text-xs text-gray-700">

                                {{-- GARIS PEMBATAS --}}
                                <div class="border-t mb-1"></div>
                                <div>
                                    <div class="text-gray-800 font-semibold  py-1">
                                        {{ $jamMasuk }} - {{ $jamKeluar }}
                                    </div>
                                </div>
                                {{-- CATATAN --}}
                                <div>
                                    <div class="text-gray-500 py-1">
                                        Catatan Kegiatan:
                                    </div>
                                    <div class="-mt-5 text-gray-800 whitespace-pre-line">
                                        {{ $item->keterangan ?? '-' }}
                                    </div>
                                </div>

                                {{-- GARIS PEMBATAS --}}
                                <div class="border-t mt-1"></div>

                                {{-- SUMBER --}}
                                <div class="flex justify-between py-1">
                                    <span class="text-gray-500">Sumber</span>
                                    <span class="text-gray-800 font-medium">
                                        @if (in_array($item->status, ['izin', 'sakit']))
                                            {{ $item->pengajuan_id ? 'Pengajuan' : 'Manual' }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>

                                {{-- DIUBAH --}}
                                <div class="flex justify-between py-1">
                                    <span class="text-gray-500">Diubah</span>

                                    @if ($item->updated_at && $item->updated_at != $item->created_at)
                                        <div class="text-right leading-tight">

                                            {{-- TANGGAL --}}
                                            <div class="text-gray-800 font-medium">
                                                {{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/y H:i') }}
                                            </div>

                                            {{-- ADMIN --}}
                                            @if ($item->updatedBy)
                                                <span class="text-[10px] text-gray-500 italic">
                                                    oleh {{ $item->updatedBy->name }}
                                                </span>
                                            @endif

                                        </div>
                                    @else
                                        <span>-</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                    @empty
                        <div class="text-center text-gray-500 py-10">
                            Belum ada data presensi
                        </div>
                    @endforelse

                </div>

                {{-- DESKTOP TABLE --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm border-collapse table-fixed">
                        <thead class="bg-gray-100">
                            <tr class="text-xs uppercase tracking-wide text-gray-500 border-b text-center">
                                <th class="px-4 py-3 w-12">No</th>
                                <th class="px-4 py-3 text-left">Tanggal</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Sumber</th>
                                <th class="px-4 py-3">Masuk</th>
                                <th class="px-4 py-3">Keluar</th>
                                <th class="px-4 py-3 text-left w-[400px]">Catatan</th>
                                <th class="px-4 py-3">Diubah</th>

                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($presensi as $i => $item)
                                @php
                                    $displayStatus =
                                        $item->status === 'hadir' && $item->is_late ? 'telat' : $item->status;
                                @endphp
                                <tr class="border-b hover:bg-gray-50 text-center">
                                    <td class="px-4 py-4">
                                        {{ ($presensi->currentPage() - 1) * $presensi->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-4 text-left whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        @if ($displayStatus === 'telat' && $item->late_minutes)
                                            <div class="flex flex-col items-center leading-tight">
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusMap[$displayStatus] }}">
                                                    {{ $statusLabel[$displayStatus] }}
                                                </span>
                                                <span class="text-[10px] text-gray-500 mt-1">
                                                    +{{ $item->late_minutes }} menit
                                                </span>
                                            </div>
                                        @else
                                            <span
                                                class="px-3 rounded-full text-xs font-semibold
                                                {{ $statusMap[$displayStatus] ?? 'text-gray-600' }}">
                                                {{ $statusLabel[$displayStatus] ?? '-' }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4">
                                        @if (in_array($item->status, ['izin', 'sakit']))
                                            {{ $item->pengajuan_id ? 'Pengajuan' : 'Manual' }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td class="px-4 py-4">{{ $item->jam_masuk ?? '-' }}</td>
                                    <td class="px-4 py-4">{{ $item->jam_keluar ?? '-' }}</td>

                                    <td class="px-4 py-4 text-left align-top">

                                        @php
                                            $keterangan = $item->keterangan ?? '-';
                                        @endphp

                                        <div x-data="{ open: false }" class="max-w-[400px]">

                                            {{-- MODE TERTUTUP --}}
                                            <div x-show="!open" class="flex items-start gap-2">

                                                <span class="truncate flex-1 text-gray-700">
                                                    {{ $keterangan }}
                                                </span>

                                                @if (strlen($keterangan) > 60)
                                                    <button type="button" @click="open = true"
                                                        class="text-xs text-[#123B6E] hover:underline whitespace-nowrap">
                                                        Detail
                                                    </button>
                                                @endif

                                            </div>

                                            {{-- MODE TERBUKA --}}
                                            <div x-show="open" x-transition class="space-y-1">

                                                <div class="flex items-start gap-2">

                                                    <span class="flex-1 whitespace-pre-line text-gray-700">
                                                        {{ $keterangan }}
                                                    </span>

                                                    <button type="button" @click="open = false"
                                                        class="text-xs text-[#123B6E] hover:underline whitespace-nowrap">
                                                        Tutup
                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </td>
                                    <td class="px-4 py-4 text-xs">
                                        @if ($item->updated_at && $item->updated_at != $item->created_at)
                                            <div class="flex flex-col items-center leading-tight">

                                                {{-- TANGGAL SINGKAT --}}
                                                <span>
                                                    {{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/y H:i') }}
                                                </span>

                                                {{-- ADMIN --}}
                                                @if ($item->updatedBy)
                                                    <span class="text-[10px] text-gray-500 italic">
                                                        oleh {{ $item->updatedBy->name }}
                                                    </span>
                                                @else
                                                    @if ($item->updatedBy)
                                                        <span class="text-[10px] text-gray-500 italic">
                                                            oleh {{ $item->updatedBy->name }}
                                                        </span>
                                                    @endif
                                                @endif

                                            </div>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="py-16 text-center text-gray-500">
                                        Belum ada data presensi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                {{ $presensi->onEachSide(1)->links() }}
            </div>
            
        </x-card>

        <x-modal name="export-presensi" maxWidth="md">
            <div class="p-6" x-data="{ mode: 'all', from: '', to: '', error: '' }">
                <h2 class="text-lg font-semibold mb-5 text-[#123B6E]">
                    Export Laporan Presensi
                </h2>
                {{-- MODE --}}
                <div class="space-y-3 mb-5">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="radio" value="all" x-model="mode"
                            class="text-[#123B6E] focus:ring-[#123B6E]">
                        <span class="text-sm font-medium">
                            Export Semua Data
                        </span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="radio" value="range" x-model="mode"
                            class="text-[#123B6E] focus:ring-[#123B6E]">
                        <span class="text-sm font-medium">
                            Export Berdasarkan Rentang Tanggal
                        </span>
                    </label>
                </div>
                <form method="GET" action="{{ route('user.laporan.export') }}" class="space-y-4"
                    x-data="{
                        validate() {
                                if (this.from && this.to && this.to < this.from) {
                                    this.error = 'Tanggal selesai tidak boleh sebelum tanggal mulai';
                                } else {
                                    this.error = '';
                                }
                            },
                            get isInvalid() {
                                if (mode === 'range') {
                                    return !this.from || !this.to || this.error !== '';
                                }
                                return false;
                            }
                    }">

                    {{-- RANGE INPUT --}}
                    <div x-show="mode === 'range'" x-transition class="space-y-4">

                        <div>
                            <label class="text-sm font-medium text-gray-600">
                                Dari Tanggal*
                            </label>
                            <input type="date" name="from" x-model="from"
                                :max="new Date().toISOString().split('T')[0]" @change="validate()"
                                class="w-full mt-1 border rounded-lg px-3 py-2">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">
                                Sampai Tanggal*
                            </label>
                            <input type="date" name="to" x-model="to" :min="from"
                                :max="new Date().toISOString().split('T')[0]" @change="validate()"
                                class="w-full mt-1 border rounded-lg px-3 py-2">
                        </div>

                        <div x-show="error">
                            <x-alert-error>
                                <span x-text="error"></span>
                            </x-alert-error>
                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div class="flex justify-end gap-3 pt-4 border-t">

                        <x-button type="button" variant="secondary"
                            x-on:click="$dispatch('close-modal', 'export-presensi')">
                            Batal
                        </x-button>

                        <x-button type="submit" variant="primary" x-bind:disabled="isInvalid"
                            x-bind:class="isInvalid ? 'opacity-50 cursor-not-allowed' : ''"
                            @click="
                                if(!error){
                                    $dispatch('close-modal', 'export-presensi');
                                    window.dispatchEvent(new CustomEvent('user-toast', {
                                        detail: {
                                            title: 'Berhasil',
                                            message: 'Laporan sedang diunduh'
                                        }
                                    }));
                                }
                            ">
                            Download PDF
                        </x-button>

                    </div>

                </form>

            </div>

        </x-modal>
    </div>
</x-appuser-layout>
