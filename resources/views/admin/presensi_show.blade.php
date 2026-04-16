<x-appadmin-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <span class="font-semibold text-[#0D1B2A]">
                Detail Presensi
            </span>
        </div>
    </x-slot>

    <div class="container mx-auto">
        <x-card>

            {{-- HEADER --}}
            <div class="flex items-center gap-2 mb-6">
                <x-heroicon-o-user class="w-6 h-6 text-[#0D1B2A]" />
                <div>
                    <h2 class="text-lg font-semibold text-[#0D1B2A]">
                        {{ $user->name }}
                    </h2>
                    <p class="text-xs text-gray-500">
                        Detail presensi peserta
                    </p>
                </div>
            </div>

            @if ($presensis->count())

                {{-- DESKTOP --}}
                <div class="hidden md:block">
                    <div class="-mx-6 overflow-x-auto">
                        <div class="min-w-[1050px] px-6">

                            <x-table class="text-sm w-full table-fixed">
                                <thead>
                                    <tr>
                                        <x-table-th class="w-12 text-center">No</x-table-th>
                                        <x-table-th class="w-28">Tanggal</x-table-th>
                                        <x-table-th class="w-24 text-center">Status</x-table-th>
                                        <x-table-th class="w-20 text-center">Masuk</x-table-th>
                                        <x-table-th class="w-20 text-center">Keluar</x-table-th>
                                        <x-table-th class="w-24 text-center">Sumber</x-table-th>
                                        <x-table-th class="w-28 text-center">Diubah</x-table-th>
                                        <x-table-th class="w-64">Catatan</x-table-th>
                                        <x-table-th class="w-24 text-center">Bukti</x-table-th>
                                        <x-table-th class="w-16 text-center">Aksi</x-table-th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($presensis as $p)
                                        @php
                                            $tanggal = \Carbon\Carbon::parse($p->tanggal)->format('d M Y');
                                            $editable = in_array($p->status, ['alpha', 'hadir']);
                                            $badgeClass = match ($p->status) {
                                                'hadir' => 'bg-green-100 text-green-700',
                                                'sakit' => 'bg-purple-100 text-purple-700',
                                                'izin' => 'bg-blue-100 text-blue-700',
                                                default => 'bg-red-100 text-red-700',
                                            };
                                        @endphp

                                        <tr x-data="{ open: false }" class="hover:bg-gray-50 transition">

                                            <x-table-td class="text-center">
                                                {{ ($presensis->currentPage() - 1) * $presensis->perPage() + $loop->iteration }}
                                            </x-table-td>

                                            <x-table-td>{{ $tanggal }}</x-table-td>

                                            <x-table-td class="text-center">
                                                <span
                                                    class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                                    {{ $p->status === 'alpha' ? 'Alpha' : ucfirst($p->status) }}
                                                </span>
                                            </x-table-td>

                                            <x-table-td class="text-center">
                                                {{ $p->jam_masuk ? \Carbon\Carbon::parse($p->jam_masuk)->format('H:i:s') : '-' }}
                                            </x-table-td>

                                            <x-table-td class="text-center">
                                                {{ $p->jam_keluar ? \Carbon\Carbon::parse($p->jam_keluar)->format('H:i:s') : '-' }}
                                            </x-table-td>

                                            <x-table-td class="text-center">
                                                @if (in_array($p->status, ['izin', 'sakit']))
                                                    {{ $p->pengajuan_id ? 'Pengajuan' : 'Manual' }}
                                                @else
                                                    -
                                                @endif
                                            </x-table-td>

                                            <x-table-td class="text-center text-xs">
                                                @if ($p->updated_at && $p->updated_at != $p->created_at)
                                                    <div class="flex flex-col items-center leading-tight">

                                                        {{-- WAKTU --}}
                                                        <span>
                                                            {{ \Carbon\Carbon::parse($p->updated_at)->format('d M Y H:i') }}
                                                        </span>

                                                        {{-- ADMIN --}}
                                                        @if ($p->updatedBy)
                                                            <span class="text-[10px] text-gray-500 italic">
                                                                oleh {{ $p->updatedBy->name }}
                                                            </span>
                                                        @endif

                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </x-table-td>

                                            {{-- CATATAN --}}
                                            <x-table-td class="w-56 align-middle">
                                                <div class="flex items-center h-full">

                                                    @if (!empty($p->keterangan))
                                                        @php
                                                            $isLong = strlen($p->keterangan ?? '') > 40;
                                                        @endphp

                                                        <div x-data="{ open: false }"
                                                            class="text-sm text-gray-700 w-full">

                                                            @if ($isLong)
                                                                {{-- CLOSED VIEW --}}
                                                                <div x-show="!open" class="flex items-center w-full">

                                                                    {{-- TEXT --}}
                                                                    <span class="truncate">
                                                                        {{ \Illuminate\Support\Str::limit($p->keterangan, 40) }}
                                                                    </span>

                                                                    {{-- BUTTON POJOK KANAN --}}
                                                                    <button @click="open = true"
                                                                        class="ml-auto text-xs text-blue-600 hover:underline whitespace-nowrap">
                                                                        Detail
                                                                    </button>

                                                                </div>

                                                                {{-- OPEN VIEW --}}
                                                                <div x-show="open" x-transition>
                                                                    <div class="flex justify-end">
                                                                        <button @click="open = false"
                                                                            class="text-xs text-blue-600 hover:underline">
                                                                            Tutup
                                                                        </button>
                                                                    </div>

                                                                    <div class="whitespace-pre-line break-words">
                                                                        {{ $p->keterangan }}
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="whitespace-pre-line break-words">
                                                                    {{ $p->keterangan }}
                                                                </div>
                                                            @endif

                                                        </div>
                                                    @else
                                                        <span class="text-gray-400">-</span>
                                                    @endif

                                                </div>
                                            </x-table-td>

                                            <x-table-td align="center">
                                                <div class="flex items-center justify-center gap-1">
                                                    @if ($p->bukti)
                                                        <a href="{{ asset('storage/' . $p->bukti) }}" target="_blank"
                                                            class="flex items-center gap-1 text-[#123B6E] hover:underline">
                                                            <x-heroicon-o-document-arrow-down class="w-4 h-4" />
                                                            <span>File</span>
                                                        </a>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </div>
                                            </x-table-td>

                                            {{-- AKSI --}}
                                            <x-table-td class="text-center">
                                                @if ($editable)
                                                    <button onclick="openEditModal({{ $p->id }})"
                                                        class="text-blue-600 hover:underline text-sm font-semibold">
                                                        Update
                                                    </button>
                                                @else
                                                    <span class="text-gray-400 text-sm">Update</span>
                                                @endif
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

                    @foreach ($presensis as $p)
                        @php
                            $tanggal = \Carbon\Carbon::parse($p->tanggal)->format('d M Y');
                            $editable = in_array($p->status, ['alpha', 'hadir']);
                            $badgeClass = match ($p->status) {
                                'hadir' => 'bg-green-100 text-green-700',
                                'sakit' => 'bg-purple-100 text-purple-700',
                                'izin' => 'bg-blue-100 text-blue-700',
                                default => 'bg-red-100 text-red-700',
                            };
                        @endphp

                        <div class="bg-white border rounded-2xl p-4 shadow-sm" x-data="{ open: false }">

                            <div class="flex justify-between items-start">
                                <p class="font-semibold text-sm text-[#0D1B2A]">
                                    {{ $tanggal }}
                                </p>

                                @if ($editable)
                                    <button type="button" onclick="openEditModal({{ $p->id }})"
                                        class="rounded-md text-yellow-500 hover:bg-yellow-500/10" title="Edit Presensi">
                                        <x-heroicon-o-pencil-square class="w-5 h-5" />
                                    </button>
                                @else
                                    <span class="p-1.5 rounded-md text-gray-400">
                                        <x-heroicon-o-pencil-square class="w-5 h-5" />
                                    </span>
                                @endif
                            </div>

                            <div class="flex justify-between text-sm mt-2">
                                <span>
                                    {{ $p->jam_masuk ? \Carbon\Carbon::parse($p->jam_masuk)->format('H:i:s') : '' }}
                                    -
                                    {{ $p->jam_keluar ? \Carbon\Carbon::parse($p->jam_keluar)->format('H:i:s') : '' }}
                                </span>

                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                    {{ $p->status === 'alpha' ? 'Alpha' : ucfirst($p->status) }}
                                </span>
                            </div>

                            <div class="mt-2">
                                <button @click="open=!open" class="text-xs text-blue-600 hover:underline">
                                    <span x-show="!open">Detail</span>
                                    <span x-show="open">Tutup</span>
                                </button>
                            </div>

                            <div x-show="open" x-transition class="mt-3 text-sm text-gray-700">

                                <div class="border-t my-3"></div>

                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-500">Sumber</span>
                                    <span>
                                        @if (in_array($p->status, ['izin', 'sakit']))
                                            {{ $p->pengajuan_id ? 'Pengajuan' : 'Manual' }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>

                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-500">Diubah</span>
                                    <span class="text-xs">
                                        @if ($p->updated_at && $p->updated_at != $p->created_at)
                                            {{ \Carbon\Carbon::parse($p->updated_at)->format('d M Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>
                                <div class="border-t my-3"></div>

                                <div class="whitespace-pre-line -mt-6">
                                    {{ $p->keterangan ?? '-' }}
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            @endif
            <div class="flex justify-end mt-6">
                {{ $presensis->onEachSide(1)->links() }}
            </div>
            @foreach ($presensis as $p)
                @if (in_array($p->status, ['alpha', 'hadir']))
                    <div id="edit-modal-{{ $p->id }}"
                        class="fixed inset-0 hidden z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center px-4">

                        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl px-6 py-4">
                            <div class="text-center ">
                                <h3 class="text-lg font-semibold text-[#0D1B2A]">
                                    Edit Presensi
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ $user->name }} • {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}
                                </p>
                            </div>

                            {{-- 🔴 BAGIAN INI SAJA YANG DIUBAH --}}

                            <form method="POST" action="{{ route('admin.presensi.update', $p->id) }}"
                                enctype="multipart/form-data" x-data="{ status: '{{ old('status', $p->status) }}' }" class="space-y-4">
                                @csrf
                                @method('PATCH')
                                <div>

                                    {{-- ERROR DI DALAM MODAL --}}
                                    @if ($errors->any())
                                        <div class="bg-red-100 text-red-700 text-sm  p-3 rounded-xl">
                                            <ul class="list-disc list-inside space-y-1">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                {{-- STATUS --}}
                                <div>
                                    <label class="text-sm text-gray-600">Status</label>
                                    <select name="status" x-model="status"
                                        @change="if(status !== 'hadir'){ $refs.jamMasuk.value=''; $refs.jamKeluar.value='' }"
                                        class="w-full border rounded-xl p-2 mt-1">
                                        <option value="hadir">Hadir</option>
                                        <option value="alpha">Alpha</option>
                                        <option value="izin">Izin (Manual)</option>
                                        <option value="sakit">Sakit (Manual)</option>
                                    </select>
                                </div>

                                {{-- INFO DINAMIS --}}
                                <div x-show="status === 'alpha'" class="text-yellow-700 text-xs rounded-lg">
                                    Jam masuk & keluar akan dikosongkan otomatis.
                                </div>

                                <div x-show="status === 'hadir'" class="text-yellow-700 text-xs rounded-lg">
                                    Jam masuk, jam keluar, dan keterangan wajib diisi.
                                </div>

                                <div x-show="status === 'izin' || status === 'sakit'"
                                    class="text-red-600 text-xs rounded-lg">
                                    Keterangan wajib diisi & bukti wajib diupload.
                                </div>

                                <div class="grid grid-cols-2 gap-3">

                                    {{-- JAM MASUK --}}
                                    <div>
                                        <label class="text-sm text-gray-600">Jam Masuk</label>
                                        <input type="time" step="1" name="jam_masuk" x-ref="jamMasuk"
                                            :disabled="status !== 'hadir'"
                                            value="{{ old('jam_masuk', $p->jam_masuk ? \Carbon\Carbon::parse($p->jam_masuk)->format('H:i:s') : '') }}"
                                            class="w-full border rounded-xl p-2 mt-1">
                                    </div>

                                    {{-- JAM KELUAR --}}
                                    <div>
                                        <label class="text-sm text-gray-600">Jam Keluar</label>
                                        <input type="time" step="1" name="jam_keluar" x-ref="jamKeluar"
                                            :disabled="status !== 'hadir'"
                                            value="{{ old('jam_keluar', $p->jam_keluar ? \Carbon\Carbon::parse($p->jam_keluar)->format('H:i:s') : '') }}"
                                            class="w-full border rounded-xl p-2 mt-1">
                                    </div>

                                </div>
                                {{-- KETERANGAN --}}
                                <div>
                                    <label class="text-sm text-gray-600">Keterangan</label>
                                    <textarea id="keterangan-{{ $p->id }}" name="keterangan" rows="3"
                                        class="w-full border rounded-xl p-2 mt-1">{{ old('keterangan', $p->keterangan) }}</textarea>
                                </div>

                                {{-- BUKTI --}}
                                <div>
                                    <label class="text-sm text-gray-600">Bukti</label>

                                    <input type="file" name="bukti"
                                        class="w-full border rounded-xl p-2 mt-1 text-sm">

                                    {{-- preview file lama --}}
                                    @if ($p->bukti)
                                        <a href="{{ asset('storage/' . $p->bukti) }}" target="_blank"
                                            class="text-xs text-[#123B6E] hover:underline mt-1 inline-block">
                                            Lihat file saat ini
                                        </a>
                                    @endif

                                    <p class="text-xs text-gray-400 mt-1">
                                        Format: JPG, PNG, PDF (maks 2MB)
                                    </p>
                                </div>

                                <div class="flex justify-end gap-3 pt-4 border-t">
                                    <button type="button" onclick="closeEditModal({{ $p->id }})"
                                        class="px-4 py-2 bg-gray-200 rounded-xl text-sm">
                                        Batal
                                    </button>

                                    <button type="submit"
                                        class="px-4 py-2 bg-[#0D1B2A] text-white rounded-xl text-sm">
                                        Simpan
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>

                    {{-- AUTO BUKA MODAL JIKA ADA ERROR --}}
                    @if ($errors->any())
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                openEditModal({{ $p->id }});
                            });
                        </script>
                    @endif
                @endif
            @endforeach

        </x-card>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const textareas = document.querySelectorAll('textarea[name="keterangan"]');

            textareas.forEach(textarea => {

                textarea.addEventListener('keydown', function(e) {

                    if (e.key === 'Enter') {
                        e.preventDefault();

                        let lines = this.value.split(/\r?\n/).filter(line => line.trim() !== '');

                        if (lines.length === 0) {
                            this.value = "1. ";
                            return;
                        }

                        const isNumbered = /^\d+\.\s/.test(lines[0]);

                        if (!isNumbered) {
                            lines = lines.map((line, index) => {
                                return (index + 1) + '. ' + line.replace(/^\d+\.\s/, '');
                            });

                            this.value = lines.join('\n') + '\n' + (lines.length + 1) + '. ';
                        } else {
                            this.value += '\n' + (lines.length + 1) + '. ';
                        }
                    }

                });

            });

        });

        function openEditModal(id) {
            document.getElementById('edit-modal-' + id).classList.remove('hidden');
        }

        function closeEditModal(id) {
            document.getElementById('edit-modal-' + id).classList.add('hidden');
        }
    </script>

</x-appadmin-layout>
