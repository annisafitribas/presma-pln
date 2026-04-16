<x-appuser-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <span class="font-semibold text-[#0D1B2A]">Pengajuan Izin</span>
    </x-slot>

    @php
        $minDate = now()->format('Y-m-d');
    @endphp

    <div x-data="{
        openForm: {{ $errors->any() ? 'true' : 'false' }},
        startDate: '{{ old('tgl_mulai') }}'
    }" class="mb-6 space-y-6">

        {{-- CARD LIST --}}
        <x-card class="p-0 overflow-hidden">

            {{-- HEADER CARD --}}
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2 text-[#123B6E] font-semibold">
                    <x-heroicon-o-document-text class="w-5 h-5" />
                    Ketidakhadiran
                </div>

                <x-user-button icon="heroicon-o-plus-circle" @click="$dispatch('open-modal', 'pengajuan-form')">
                    Ajukan
                </x-user-button>
            </div>

            {{-- TABLE --}}
            <div class="mt-6">

                {{-- MOBILE CARD --}}
                <div class="md:hidden space-y-4">

                    @forelse($pengajuans as $item)
                        @php
                            $statusClass = [
                                'pending' => 'text-yellow-600',
                                'approved' => 'text-green-600',
                                'rejected' => 'text-red-600',
                            ];
                        @endphp

                        <div x-data="{ open: false }" class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">

                            {{-- HEADER --}}
                            <div class="text-sm font-semibold text-gray-800">
                                {{ \Carbon\Carbon::parse($item->tgl_mulai)->format('d M Y') }}
                                –
                                {{ \Carbon\Carbon::parse($item->tgl_selesai)->format('d M Y') }}
                            </div>

                            {{-- ROW 1 --}}
                            <div class="mt-2 flex justify-between items-center text-sm">
                                <div>
                                    {{ $item->jenis === 'sakit' ? 'Sakit' : 'Izin' }}
                                </div>

                                <span
                                    class="text-xs font-semibold capitalize {{ $statusClass[$item->status] ?? 'text-gray-500' }}">
                                    {{ $item->status }}
                                </span>
                            </div>

                            {{-- ROW 2 --}}
                            <div class="mt-3 flex justify-between items-center text-sm">

                                {{-- Lihat --}}
                                <div>
                                    @if ($item->bukti)
                                        <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank"
                                            class="inline-flex items-center gap-1 text-xs font-medium text-[#123B6E] hover:underline">
                                            <x-heroicon-o-document-text class="w-4 h-4" />
                                            Lihat Dokumen
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </div>

                                {{-- DETAIL BUTTON --}}
                                <button type="button" @click="open = !open"
                                    class="text-xs font-medium text-[#123B6E] hover:underline">
                                    <span x-show="!open">Detail</span>
                                    <span x-show="open">Tutup</span>
                                </button>

                            </div>

                            {{-- EXPAND SECTION --}}
                            <div x-show="open" x-transition class="mt-4 pt-3 border-t text-sm space-y-3">

                                {{-- Feedback Admin --}}
                                <div>
                                    <div class="text-xs text-gray-500 mb-1">
                                        Feedback Admin
                                    </div>
                                    <div class="text-gray-800">
                                        {{ $item->catatan_admin ?? '-' }}
                                    </div>
                                </div>

                                {{-- Alasan --}}
                                <div>
                                    <div class="text-xs text-gray-500 mb-1">
                                        Alasan
                                    </div>
                                    <div class="text-gray-800">
                                        {{ $item->keterangan ?? '-' }}
                                    </div>
                                </div>

                            </div>

                        </div>

                    @empty
                        <div class="text-center text-gray-500 py-10">
                            Belum ada data pengajuan
                        </div>
                    @endforelse

                </div>
                {{-- DESKTOP TABLE --}}
                <div class="hidden md:block overflow-x-auto">

                    <table class="w-full text-sm border-collapse">

                        <thead class="bg-gray-100">
                            <tr class="text-xs uppercase tracking-wide text-gray-500 border-b">
                                <th class="px-4 py-3 text-left w-12">No</th>
                                <th class="px-4 py-3 text-left">Tanggal</th>
                                <th class="px-4 py-3 text-center">Jenis</th>
                                <th class="px-4 py-3 text-left">Keterangan</th>
                                <th class="px-4 py-3 text-left">Feedback Admin</th>
                                <th class="px-4 py-3 text-center">Dokumen</th>
                                <th class="px-4 py-3 text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pengajuans as $i => $item)
                                @php
                                    $statusClass = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'approved' => 'bg-green-100 text-green-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp

                                <tr class="border-b hover:bg-gray-50">

                                    <td class="px-4 py-4">
                                        {{ $i + 1 }}
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item->tgl_mulai)->format('d M Y') }}
                                        –
                                        {{ \Carbon\Carbon::parse($item->tgl_selesai)->format('d M Y') }}
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        @if ($item->jenis === 'sakit')
                                            <span class="text-sm">
                                                Sakit
                                            </span>
                                        @else
                                            <span class="text-sm ">
                                                Izin
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4">
                                        @php
                                            $keterangan = $item->keterangan ?? '-';
                                        @endphp

                                        <div x-data="{ open: false }" class="max-w-[300px]">

                                            {{-- MODE TERTUTUP --}}
                                            <div x-show="!open" class="flex items-start gap-2">

                                                <span class="truncate flex-1">
                                                    {{ $keterangan }}
                                                </span>

                                                @if (strlen($keterangan) > 25)
                                                    <button type="button" @click="open = true"
                                                        class="text-xs text-[#123B6E] hover:underline whitespace-nowrap">
                                                        Detail
                                                    </button>
                                                @endif
                                            </div>

                                            {{-- MODE TERBUKA --}}
                                            <div x-show="open" class="space-y-1">

                                                <div class="flex items-start gap-2">
                                                    <span class="flex-1 break-words">
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

                                    <td class="px-4 py-4">
                                        {{ $item->catatan_admin ?? '-' }}
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        @if ($item->bukti)
                                            <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank"
                                                class="inline-flex items-center gap-1 text-sm font-medium text-[#123B6E] hover:underline">
                                                <x-heroicon-o-document-text class="w-4 h-4" />
                                                Lihat
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $statusClass[$item->status] ?? 'bg-gray-100 text-gray-600' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="py-16 text-center text-gray-500">
                                        Belum ada data pengajuan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                {{ $pengajuans->onEachSide(1)->links() }}
            </div>

        </x-card>

        <x-modal name="pengajuan-form" :show="$errors->any() || session('error')" maxWidth="md">

            <div class="px-5 py-6 sm:px-6 space-y-5">

                {{-- HEADER --}}
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold text-lg text-[#123B6E]">
                        Ajukan Izin / Sakit
                    </h3>
                    <button @click="$dispatch('close-modal', 'pengajuan-form')">
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                    </button>
                </div>

                {{-- VALIDATION ERROR --}}
                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <div class="font-semibold mb-1">
                            Terjadi kesalahan
                        </div>

                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- SESSION ERROR --}}
                @if (session('error'))
                    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <div class="font-semibold mb-1">
                            Terjadi kesalahan
                        </div>
                        <div>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('user.pengajuan.store') }}" enctype="multipart/form-data"
                    novalidate class="space-y-4">

                    @csrf

                    {{-- JENIS --}}
                    <div>
                        <x-input-label>Jenis Pengajuan*</x-input-label>

                        <x-select-box name="jenis" :value="old('jenis')" :options="[
                            'izin' => 'Izin',
                            'sakit' => 'Sakit',
                        ]"
                            placeholder="-- Pilih Jenis --" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label>Tanggal Mulai*</x-input-label>
                            <x-input type="date" name="tgl_mulai" min="{{ $minDate }}" x-model="startDate"
                                value="{{ old('tgl_mulai') }}" required class="h-9 text-sm px-3" />
                        </div>

                        <div>
                            <x-input-label>Tanggal Selesai*</x-input-label>
                            <x-input type="date" name="tgl_selesai"
                                x-bind:min="startDate || '{{ $minDate }}'" value="{{ old('tgl_selesai') }}"
                                required class="h-9 text-sm px-3" />
                        </div>
                    </div>

                    <div>
                        <x-input-label>Keterangan*</x-input-label>
                        <textarea placeholder="Masukkan detail keterangan/alasan" name="keterangan"
                            class="w-full rounded-lg border-gray-300">{{ old('keterangan') }}</textarea>
                    </div>

                    <div>
                        <div x-data="{ preview: null }">

                            <div class="flex justify-between items-center">
                                <x-input-label>Dokumen*</x-input-label>
                                <p class="text-xs text-gray-500">
                                    PDF / JPG / PNG • Maks 2MB
                                </p>
                            </div>

                            <input type="file" name="bukti" accept=".jpg,.jpeg,.png,.pdf"
                                class="mt-2 block w-full text-sm border rounded-lg p-2"
                                @change="
                                    const file = $event.target.files[0];
                                    if (file && file.type.startsWith('image/')) {
                                        preview = URL.createObjectURL(file);
                                    } else {
                                        preview = null;
                                    }
                                ">
                        </div>
                    </div>

                    <div class="flex gap-2 pt-4 border-t">
                        <x-user-button type="button" variant="secondary" class="flex-1"
                            @click="$dispatch('close-modal', 'pengajuan-form')">
                            Batal
                        </x-user-button>

                        <x-user-button type="submit" class="flex-1">
                            Kirim
                        </x-user-button>
                    </div>

                </form>

            </div>
        </x-modal>

    </div>
    {{-- CONFIRM MODAL --}}
    <x-user-confirm-modal id="confirm-pengajuan" title="Kirim Pengajuan"
        message="Apakah Anda yakin ingin mengirim pengajuan izin/sakit ini?">
        <x-user-button type="button"
            @click="
                    openForm = false;
                    $dispatch('close-user-confirm', { id: 'confirm-pengajuan' });
                    $dispatch('submit-pengajuan');
                ">
            Ya, Kirim
        </x-user-button>
    </x-user-confirm-modal>

    </div>

</x-appuser-layout>
