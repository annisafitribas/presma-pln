<x-appadmin-layout>

    <x-slot name="header">
        <div class="flex items-center gap-2 text-[#0D1B2A]">
            <span class="font-semibold">Daftar Telat</span>
        </div>
    </x-slot>

    <div class="container mx-auto">
        <x-card>

            {{-- HEADER --}}
            <div class="flex items-center gap-1 mb-6">
                <x-heroicon-o-clock class="w-6 h-6 text-[#0D1B2A]" />
                <h2 class="text-lg font-semibold text-[#0D1B2A]">
                    Daftar Presensi Keterlambatan
                </h2>
            </div>

            @if ($telats->count())

                {{-- MOBILE --}}
                <div class="md:hidden space-y-4">

                    @php
                        $statusTextColor = [
                            'pending' => 'text-yellow-600',
                            'approved' => 'text-green-600',
                            'rejected' => 'text-red-600',
                        ];
                    @endphp

                    @foreach ($telats as $telat)
                        <div class="bg-white border border-gray-200 rounded-lg p-5 space-y-3 shadow-sm">

                            {{-- NAMA --}}
                            <div>
                                <h3 class="font-semibold text-[#0D1B2A]">
                                    {{ $telat->user->name }}
                                </h3>
                            </div>

                            {{-- TANGGAL & JAM --}}
                            <div class="grid grid-cols-2 text-sm text-gray-700">
                                <div>
                                    {{ $telat->tanggal->format('d M Y') }}
                                </div>
                                <div class="text-right">
                                    {{ $telat->jam_masuk }}
                                </div>
                            </div>

                            {{-- STATUS & AKSI --}}
                            <div class="grid grid-cols-2 text-sm items-center">
                                <div class="font-medium {{ $statusTextColor[$telat->status] }}">
                                    {{ ucfirst($telat->status) }}
                                </div>

                                <div class="text-right">
                                    @if ($telat->status === 'pending')
                                        <button type="button"
                                            x-on:click="$dispatch('open-modal', 'status-{{ $telat->id }}')"
                                            class="text-blue-600 hover:underline text-sm">
                                            Update
                                        </button>
                                    @else
                                        <span class="text-gray-500 text-sm">Update</span>
                                    @endif
                                </div>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            {{-- ALASAN --}}
                            <div class="text-sm text-gray-700 break-words">
                                {{ $telat->alasan }}
                            </div>

                            <div class="text-sm">
                                @if ($telat->bukti)
                                    <a href="{{ asset('storage/' . $telat->bukti) }}" target="_blank"
                                        class="text-blue-600 underline">
                                        <x-heroicon-o-document-arrow-down class="w-4 h-4" />
                                        <span>File</span>
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>


                {{-- DESKTOP --}}
                <div class="hidden md:block">
                    <x-table class="w-full table-fixed">
                        <thead>
                            <tr>
                                <x-table-th align="center" class="w-14">No</x-table-th>
                                <x-table-th>Nama</x-table-th> {{-- default left --}}
                                <x-table-th>Tanggal</x-table-th> {{-- default left --}}
                                <x-table-th align="left">Alasan</x-table-th>
                                <x-table-th align="center">Bukti</x-table-th>
                                <x-table-th align="center">Jam Masuk</x-table-th>
                                <x-table-th align="center">Status</x-table-th>
                                <x-table-th align="center">Aksi</x-table-th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($telats as $telat)
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp

                                <tr class="hover:bg-gray-50">

                                    {{-- NO --}}
                                    <x-table-td align="center" class="font-medium text-gray-700">
                                        {{ ($telats->currentPage() - 1) * $telats->perPage() + $loop->iteration }}
                                    </x-table-td>

                                    {{-- NAMA (LEFT) --}}
                                    <x-table-td class="font-semibold">
                                        {{ $telat->user->name }}
                                    </x-table-td>

                                    {{-- TANGGAL (LEFT) --}}
                                    <x-table-td>
                                        {{ $telat->tanggal->format('d M Y') }}
                                    </x-table-td>

                                    {{-- ALASAN --}}
                                    <x-table-td align="left" class="break-words">
                                        {{ $telat->alasan }}
                                    </x-table-td>

                                    <x-table-td align="center">
                                        <div class="flex items-center justify-center gap-1">
                                            @if ($telat->bukti)
                                                <a href="{{ asset('storage/' . $telat->bukti) }}" target="_blank"
                                                    class="flex items-center gap-1 text-[#123B6E] hover:underline">
                                                    <x-heroicon-o-document-arrow-down class="w-4 h-4" />
                                                    <span>File</span>
                                                </a>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </div>
                                    </x-table-td>

                                    {{-- JAM --}}
                                    <x-table-td align="center">
                                        {{ $telat->jam_masuk }}
                                    </x-table-td>

                                    {{-- STATUS --}}
                                    <x-table-td align="center">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$telat->status] }}">
                                            {{ ucfirst($telat->status) }}
                                        </span>
                                    </x-table-td>

                                    {{-- AKSI --}}
                                    <x-table-td align="center">
                                        @if ($telat->status === 'pending')
                                            <button type="button"
                                                x-on:click="$dispatch('open-modal', 'status-{{ $telat->id }}')"
                                                class="text-blue-600 hover:underline text-sm font-semibold">
                                                Update
                                            </button>
                                        @else
                                            <span class="text-gray-500 text-sm">Update</span>
                                        @endif
                                    </x-table-td>

                                </tr>
                            @endforeach
                        </tbody>

                    </x-table>
                </div>

                <div class="flex justify-end mt-6">
                    {{ $telats->onEachSide(1)->links() }}
                </div>
            @else
                <div class="text-center py-10 text-gray-500">
                    Belum ada pengajuan telat
                </div>
            @endif

        </x-card>
    </div>

    {{-- MODALS --}}
    @foreach ($telats as $telat)
        <x-modal name="status-{{ $telat->id }}" maxWidth="lg">

            <form id="form-status-{{ $telat->id }}" method="POST"
                action="{{ route('admin.telat.updateStatus', $telat->id) }}" enctype="multipart/form-data"
                class="p-6 space-y-4">

                @csrf
                @method('PATCH')

                <h3 class="text-xl font-semibold text-[#0D1B2A]">
                    Update Peserta Magang Telat
                </h3>

                {{-- ERROR --}}
                @if (old('telat_id') == $telat->id && $errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-3 space-y-1">
                        @error('status')
                            <div>• {{ $message }}</div>
                        @enderror
                        @error('catatan_admin')
                            <div>• {{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <input type="hidden" name="telat_id" value="{{ $telat->id }}">
                <input type="hidden" name="status" id="status-value-{{ $telat->id }}">

                {{-- DETAIL --}}
                <div class="border border-gray-200 rounded-xl bg-white text-sm">
                    <div class="p-3 space-y-3">

                        <div>
                            <p class="mt-1 text-base font-semibold text-[#0D1B2A]">
                                {{ $telat->user->name }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-medium text-gray-500 tracking-wider">
                                    Tanggal
                                </p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $telat->tanggal->format('d M Y') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-medium text-gray-500 tracking-wider">
                                    Jam Masuk
                                </p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $telat->jam_masuk }}
                                </p>
                            </div>
                        </div>

                        <div class="border-t border-gray-200"></div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 tracking-wider">
                                Alasan Keterlambatan
                            </p>
                            <p class="mt-2 text-gray-700 leading-relaxed break-words">
                                {{ $telat->alasan }}
                            </p>
                        </div>

                        <div class="border-t border-gray-200"></div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 tracking-wider">
                                Upload Bukti (Admin)
                            </p>

                            <input type="file" name="bukti"
                                class="mt-2 block w-full text-sm border rounded-lg p-2">
                        </div>

                    </div>
                </div>

                {{-- STATUS BUTTON --}}
                <div class="flex gap-3">
                    <button type="button" onclick="setStatus({{ $telat->id }}, 'approved')"
                        class="flex-1 border rounded-xl py-2 text-sm transition
                        border-green-300 text-green-700 hover:bg-green-50"
                        id="btn-approved-{{ $telat->id }}">
                        Disetujui
                    </button>

                    <button type="button" onclick="setStatus({{ $telat->id }}, 'rejected')"
                        class="flex-1 border rounded-xl py-2 text-sm transition
                        border-red-300 text-red-700 hover:bg-red-50"
                        id="btn-rejected-{{ $telat->id }}">
                        Ditolak
                    </button>
                </div>

                {{-- CATATAN --}}
                <textarea name="catatan_admin" id="catatan-{{ $telat->id }}" rows="3"
                    placeholder="Tambahkan catatan admin..."
                    class="w-full border rounded-xl p-3 text-sm
                    @if (old('telat_id') == $telat->id && $errors->has('catatan_admin')) border-red-500 focus:border-red-500 focus:ring-red-200 @endif">{{ old('telat_id') == $telat->id ? old('catatan_admin') : '' }}</textarea>

                {{-- ACTION --}}
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <x-button type="button" variant="secondary"
                        x-on:click="$dispatch('close-modal', 'status-{{ $telat->id }}')">
                        Batal
                    </x-button>

                    <x-button type="submit" variant="primary">
                        Simpan
                    </x-button>
                </div>

            </form>
        </x-modal>
    @endforeach


    {{-- AUTO REOPEN --}}
    @if ($errors->any() && old('telat_id'))
        <script>
            window.addEventListener('load', () => {
                window.dispatchEvent(
                    new CustomEvent('open-modal', {
                        detail: 'status-{{ old('telat_id') }}'
                    })
                );
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        type: 'success',
                        message: "{{ session('success') }}"
                    }
                }));
            });
        </script>
    @endif
    {{-- JS --}}
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
