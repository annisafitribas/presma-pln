<x-appadmin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-[#0D1B2A]">
            <span class="font-semibold">Daftar Pengajuan</span>
        </div>
    </x-slot>

    <div class="container mx-auto">
        <x-card>

            {{-- HEADER --}}
            <div class="flex items-center gap-2 mb-4">
                <x-heroicon-o-document-check class="w-6 h-6 text-[#0D1B2A]" />
                <h2 class="text-lg font-semibold text-[#0D1B2A]">
                    Daftar Pengajuan Ketidakhadiran
                </h2>
            </div>

            @if ($pengajuans->count())

                {{-- MOBILE --}}
                <div class="md:hidden space-y-4">

                    @php
                        $statusTextColor = [
                            'pending' => 'text-yellow-600',
                            'approved' => 'text-green-600',
                            'rejected' => 'text-red-600',
                        ];
                    @endphp

                    @foreach ($pengajuans as $pengajuan)
                        <div class="bg-white border border-gray-200 rounded-xl p-4">

                            {{-- NAMA + JENIS --}}
                            <div class="flex justify-between items-start">
                                <h3 class="font-semibold text-[#0D1B2A]">
                                    {{ $pengajuan->user->name }}
                                </h3>

                                @if ($pengajuan->jenis === 'sakit')
                                    <span class="text-xs">
                                        Sakit
                                    </span>
                                @else
                                    <span class="text-xs">
                                        Izin
                                    </span>
                                @endif
                            </div>

                            {{-- EMAIL --}}
                            <div class="text-xs text-gray-500">
                                {{ $pengajuan->user->email }}
                            </div>

                            {{-- RANGE TANGGAL --}}
                            <div class="text-sm text-gray-700 py-1">
                                {{ $pengajuan->tgl_mulai->format('d M Y') }}
                                –
                                {{ $pengajuan->tgl_selesai->format('d M Y') }}
                            </div>

                            {{-- KETERANGAN --}}
                            @php
                                $text = $pengajuan->keterangan ?? null;
                            @endphp

                            @if ($text)
                                <div x-data="{ open: false }" class="text-sm text-gray-700 mt-1">

                                    {{-- CLOSED VIEW --}}
                                    <div x-show="!open" class="flex justify-between items-baseline gap-2">

                                        <span class="flex-1 truncate">
                                            {{ strlen($text) > 25 ? \Illuminate\Support\Str::limit($text, 25) : $text }}
                                        </span>

                                        <button type="button" @click="open = true"
                                            class="text-xs text-blue-600 hover:underline whitespace-nowrap">
                                            Detail
                                        </button>

                                    </div>

                                    {{-- OPEN VIEW --}}
                                    <div x-show="open" x-transition class="mt-1">

                                        <div class="flex justify-end">
                                            <button type="button" @click="open = false"
                                                class="text-xs text-blue-600 hover:underline">
                                                Tutup
                                            </button>
                                        </div>

                                        <div class="whitespace-pre-line break-words mt-1">
                                            {{ $text }}
                                        </div>

                                    </div>

                                </div>
                            @else
                                <div class="text-sm text-gray-700 mt-1">-</div>
                            @endif

                            {{-- PDF | STATUS | AKSI --}}
                            <div class="flex items-center justify-between text-sm pt-3 border-t border-gray-200">

                                {{-- LEFT : PDF --}}
                                <div class="flex items-center gap-1">
                                    @if ($pengajuan->bukti)
                                        <a href="{{ asset('storage/' . $pengajuan->bukti) }}" target="_blank"
                                            class="flex items-center gap-1 text-[#123B6E] hover:underline">
                                            <x-heroicon-o-document-arrow-down class="w-4 h-4" />
                                            <span>File</span>
                                        </a>
                                    @else
                                        <span>-</span>
                                    @endif
                                </div>

                                {{-- CENTER : STATUS --}}
                                <div class="font-medium {{ $statusTextColor[$pengajuan->status] }}">
                                    {{ ucfirst($pengajuan->status) }}
                                </div>

                                {{-- RIGHT : AKSI --}}
                                <div>
                                    @if ($pengajuan->status === 'pending')
                                        <button type="button"
                                            x-on:click="$dispatch('open-modal', 'status-{{ $pengajuan->id }}')"
                                            class="text-blue-600 hover:underline text-sm font-semibold">
                                            Update
                                        </button>
                                    @else
                                        <span class="text-gray-500 text-sm">Update</span>
                                    @endif
                                </div>

                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- DESKTOP --}}
                <div class="hidden md:block">
                    <x-table class="w-full table-fixed">
                        <thead>
                            <tr>
                                <x-table-th align="center" class="w-12">No</x-table-th>
                                <x-table-th>Nama</x-table-th>
                                <x-table-th>Tanggal</x-table-th>
                                <x-table-th align="center" class="w-[120px]">Jenis</x-table-th>
                                <x-table-th class="w-[260px]">Keterangan</x-table-th>
                                <x-table-th align="center" class="w-[120px]">File</x-table-th>
                                <x-table-th align="center" class="w-[120px]">Status</x-table-th>
                                <x-table-th align="center" class="w-[120px]">Aksi</x-table-th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pengajuans as $pengajuan)
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp

                                <tr class="hover:bg-[#0D1B2A1A] even:bg-[#F8FAFC] transition">
                                    <x-table-td align="center">
                                        {{ $loop->iteration }}
                                    </x-table-td>

                                    <x-table-td class="font-semibold">
                                        {{ $pengajuan->user->name }}
                                    </x-table-td>

                                    <x-table-td>
                                        {{ $pengajuan->tgl_mulai->format('d/m/y') }}
                                        –
                                        {{ $pengajuan->tgl_selesai->format('d/m/y') }}
                                    </x-table-td>

                                    <x-table-td align="center">
                                        {{ ucfirst($pengajuan->jenis) }}
                                    </x-table-td>

                                    <x-table-td class="align-top">

                                        @php
                                            $text = $pengajuan->keterangan ?? null;
                                        @endphp

                                        @if ($text)
                                            <div x-data="{ open: false }" class="text-sm text-gray-700">

                                                @if (strlen($text) > 40)
                                                    @php
                                                        $shortText = \Illuminate\Support\Str::limit($text, 40);
                                                    @endphp

                                                    {{-- CLOSED VIEW --}}
                                                    <div x-show="!open" class="flex items-center gap-2">
                                                        <span class="truncate max-w-[240px]">
                                                            {{ $shortText }}
                                                        </span>

                                                        <button type="button" @click="open = true"
                                                            class="text-xs text-blue-600 hover:underline whitespace-nowrap">
                                                            Detail
                                                        </button>
                                                    </div>

                                                    {{-- OPEN VIEW --}}
                                                    <div x-show="open" x-transition>
                                                        <div class="flex justify-end">
                                                            <button type="button" @click="open = false"
                                                                class="text-xs text-blue-600 hover:underline">
                                                                Tutup
                                                            </button>
                                                        </div>

                                                        <div class="whitespace-pre-line break-words mt-1">
                                                            {{ $text }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="whitespace-pre-line break-words">
                                                        {{ $text }}
                                                    </div>
                                                @endif

                                            </div>
                                        @else
                                            -
                                        @endif

                                    </x-table-td>

                                    <x-table-td align="center">
                                        @if ($pengajuan->bukti)
                                            <a href="{{ asset('storage/' . $pengajuan->bukti) }}" target="_blank"
                                                class="inline-flex items-center gap-1 text-[#123B6E] hover:underline">
                                                <x-heroicon-o-document-arrow-down class="w-4 h-4" />
                                                <span>File</span>
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </x-table-td>

                                    <x-table-td align="center">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $statusClasses[$pengajuan->status] }}">
                                            {{ ucfirst($pengajuan->status) }}
                                        </span>
                                    </x-table-td>

                                    <x-table-td align="center">
                                        @if ($pengajuan->status === 'pending')
                                            <button type="button"
                                                x-on:click="$dispatch('open-modal', 'status-{{ $pengajuan->id }}')"
                                                class="text-blue-600 hover:underline text-sm font-semibold">
                                                Update
                                            </button>
                                        @else
                                            -
                                        @endif
                                    </x-table-td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table>
                </div>
            @else
                <div class="text-center py-10 text-gray-500">
                    Belum ada data pengajuan
                </div>
            @endif

        </x-card>
    </div>

    {{-- MODALS --}}
    @foreach ($pengajuans as $pengajuan)
        <x-modal name="status-{{ $pengajuan->id }}" maxWidth="lg">

            <form method="POST" action="{{ route('admin.pengajuan.updateStatus', $pengajuan->id) }}"
                class="p-6 space-y-4">

                @csrf
                @method('PATCH')

                <h3 class="text-xl font-semibold text-[#0D1B2A]">
                    Update Status Pengajuan
                </h3>

                @if (old('pengajuan_id') == $pengajuan->id)
                    <x-alert-error />
                @endif

                <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">
                <input type="hidden" name="status" id="status-value-{{ $pengajuan->id }}">
                {{-- DETAIL PENGAJUAN --}}
                <div class="border border-gray-200 rounded-xl bg-white text-sm">
                    <div class="p-4 space-y-4">

                        {{-- NAMA --}}
                        <div>
                            <p class="text-base font-semibold text-[#0D1B2A]">
                                {{ $pengajuan->user->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $pengajuan->user->email }}
                            </p>
                        </div>

                        {{-- TANGGAL --}}
                        <div>
                            <p class="text-xs font-medium text-gray-500 tracking-wider">
                                Tanggal
                            </p>

                            <p class="mt-1 font-medium text-gray-800">
                                @if ($pengajuan->tgl_mulai->equalTo($pengajuan->tgl_selesai))
                                    {{ $pengajuan->tgl_mulai->format('d M Y') }}
                                @else
                                    {{ $pengajuan->tgl_mulai->format('d M Y') }}
                                    –
                                    {{ $pengajuan->tgl_selesai->format('d M Y') }}
                                @endif
                            </p>
                        </div>
                        <div class="border-t border-gray-200"></div>

                        {{-- JENIS --}}
                        <div>
                            <p class="text-xs font-medium text-gray-500 tracking-wider">
                                Jenis Pengajuan
                            </p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ ucfirst($pengajuan->jenis) }}
                            </p>
                        </div>

                        {{-- KETERANGAN --}}
                        <div>
                            <p class="text-xs font-medium text-gray-500 tracking-wider">
                                Keterangan
                            </p>
                            <p class="mt-2 text-gray-700 leading-relaxed break-words">
                                {{ $pengajuan->keterangan ?? '-' }}
                            </p>
                        </div>

                        {{-- FILE --}}
                        @if ($pengajuan->bukti)
                            <div>
                                <p class="text-xs font-medium text-gray-500 tracking-wider">
                                    File Bukti
                                </p>

                                <a href="{{ asset('storage/' . $pengajuan->bukti) }}" target="_blank"
                                    class="inline-flex items-center gap-2 mt-1 text-blue-600 hover:underline">
                                    <x-heroicon-o-document-arrow-down class="w-4 h-4" />
                                    Lihat File
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
                {{-- STATUS BUTTON --}}
                <div class="flex gap-3">
                    <button type="button" id="btn-approved-{{ $pengajuan->id }}"
                        onclick="setStatus({{ $pengajuan->id }}, 'approved')"
                        class="flex-1 border rounded-xl py-2 text-sm border-green-300 text-green-700">
                        Disetujui
                    </button>

                    <button type="button" id="btn-rejected-{{ $pengajuan->id }}"
                        onclick="setStatus({{ $pengajuan->id }}, 'rejected')"
                        class="flex-1 border rounded-xl py-2 text-sm border-red-300 text-red-700">
                        Ditolak
                    </button>
                </div>

                {{-- TEXTAREA --}}
                <textarea name="catatan_admin" rows="3" placeholder="Tambahkan catatan..."
                    class="w-full border rounded-xl p-3 text-sm
                    @if (old('pengajuan_id') == $pengajuan->id && $errors->has('catatan_admin')) border-red-500 focus:border-red-500 focus:ring-red-200 @endif">{{ old('pengajuan_id') == $pengajuan->id ? old('catatan_admin') : '' }}</textarea>

                {{-- ACTION --}}
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <x-button type="button" variant="secondary"
                        x-on:click="$dispatch('close-modal', 'status-{{ $pengajuan->id }}')">
                        Batal
                    </x-button>

                    <x-button type="submit" variant="primary">
                        Simpan
                    </x-button>
                </div>

            </form>

        </x-modal>
    @endforeach

    {{-- AUTO REOPEN MODAL --}}
    @if ($errors->any() && old('pengajuan_id'))
        <script>
            window.addEventListener('load', () => {
                window.dispatchEvent(
                    new CustomEvent('open-modal', {
                        detail: 'status-{{ old('pengajuan_id') }}'
                    })
                );
            });
        </script>
    @endif

    {{-- STATUS JS --}}
    <script>
        function setStatus(id, status) {

            const statusInput = document.getElementById('status-value-' + id);
            const btnApproved = document.getElementById('btn-approved-' + id);
            const btnRejected = document.getElementById('btn-rejected-' + id);

            statusInput.value = status;

            btnApproved.classList.remove('bg-green-100', 'border-green-500', 'text-green-800');
            btnRejected.classList.remove('bg-red-100', 'border-red-500', 'text-red-800');

            if (status === 'approved') {
                btnApproved.classList.add('bg-green-100', 'border-green-500', 'text-green-800');
            }

            if (status === 'rejected') {
                btnRejected.classList.add('bg-red-100', 'border-red-500', 'text-red-800');
            }
        }
    </script>

</x-appadmin-layout>
