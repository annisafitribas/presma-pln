<x-appadmin-layout>
    <x-slot name="header">
        <span class="text-[#0D1B2A]">Bidang</span>
    </x-slot>

    <div class="container mx-auto">
        <x-card>
            <div x-data="{ deleteId: null, deleteNama: '' }">

                {{-- HEADER --}}
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold flex items-center gap-2">
                        <x-heroicon-o-rectangle-stack class="w-6 h-6" />
                        Daftar Bidang
                    </h2>

                    <x-button variant="primary" icon="heroicon-o-plus-circle"
                        @click="window.dispatchEvent(
                            new CustomEvent('open-modal', { detail: 'modal-create-bidang' })
                        )">
                        Tambah
                    </x-button>
                </div>

                {{-- TABLE --}}
                @if ($bidangs->count())

                    {{-- DESKTOP --}}
                    <div class="hidden md:block">
                        <div class="-mx-6 overflow-x-auto">
                            <div class="min-w-[600px] px-6">

                                <x-table class="text-sm w-full">
                                    <thead>
                                        <tr>
                                            <x-table-th align="center" class="w-12">No</x-table-th>
                                            <x-table-th>Nama Bidang</x-table-th>
                                            <x-table-th>Kepala Bidang</x-table-th>
                                            <x-table-th align="center">Aksi</x-table-th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($bidangs as $bidang)
                                            <tr class="hover:bg-[#0D1B2A1A] even:bg-[#F8FAFC] transition">
                                                <x-table-td align="center">
                                                    {{ ($bidangs->currentPage() - 1) * $bidangs->perPage() + $loop->iteration }}
                                                </x-table-td>

                                                <x-table-td>
                                                    {{ $bidang->nama }}
                                                </x-table-td>

                                                <x-table-td>
                                                    {{ $bidang->kepala }}
                                                </x-table-td>

                                                <x-table-td align="center">
                                                    <div class="flex items-center justify-center gap-2">

                                                        {{-- EDIT --}}
                                                        <button type="button"
                                                            class="p-1.5 rounded-md text-yellow-500 hover:bg-yellow-500/10"
                                                            @click="window.dispatchEvent(
                                                        new CustomEvent('open-modal', {
                                                            detail: 'modal-edit-bidang-{{ $bidang->id }}'
                                                        })
                                                    )">
                                                            <x-heroicon-o-pencil-square class="w-5 h-5" />
                                                        </button>

                                                        {{-- DELETE --}}
                                                        @if (!$bidang->isUsed())
                                                            <button type="button"
                                                                class="p-1.5 rounded-md text-red-500 hover:bg-red-500/10"
                                                                @click="
                                                        deleteId = {{ $bidang->id }};
                                                        deleteNama = '{{ $bidang->nama }}';
                                                        window.dispatchEvent(new CustomEvent('open-confirm', {
                                                            detail: { id: 'hapus-bidang-global' }
                                                        }));
                                                    ">
                                                                <x-heroicon-o-trash class="w-5 h-5" />
                                                            </button>
                                                        @else
                                                            <span
                                                                class="p-1.5 rounded-md text-gray-400 cursor-not-allowed"
                                                                title="Bidang sudah digunakan">
                                                                <x-heroicon-o-trash class="w-5 h-5" />
                                                            </span>
                                                        @endif

                                                    </div>
                                                </x-table-td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </x-table>

                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">

                        {{ $bidangs->onEachSide(1)->links() }}

                    </div>

                    {{-- MOBILE --}}
                    <div class="md:hidden space-y-4">
                        @foreach ($bidangs as $bidang)
                            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">

                                <div class="flex items-start justify-between">

                                    {{-- INFO --}}
                                    <div>
                                        <p class="font-semibold text-[#0D1B2A] text-sm">
                                            {{ $bidang->nama }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            Kepala: {{ $bidang->kepala }}
                                        </p>
                                    </div>

                                    {{-- MENU --}}
                                    <div x-data="{ open: false }" class="relative">

                                        <button type="button" @click="open = !open"
                                            class="p-2 rounded-lg hover:bg-gray-100">
                                            <x-heroicon-o-ellipsis-vertical class="w-5 h-5 text-gray-600" />
                                        </button>

                                        <div x-show="open" @click.away="open = false" x-transition
                                            class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-2xl shadow-xl py-2 z-50">

                                            {{-- EDIT --}}
                                            <button type="button"
                                                class="flex items-center gap-2 w-full px-3 py-2 text-sm text-yellow-600 hover:bg-yellow-50"
                                                @click="
                                            open = false;
                                            window.dispatchEvent(
                                                new CustomEvent('open-modal', {
                                                    detail: 'modal-edit-bidang-{{ $bidang->id }}'
                                                })
                                            )
                                        ">
                                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                                                Edit
                                            </button>

                                            {{-- DELETE --}}
                                            @if (!$bidang->isUsed())
                                                <button type="button"
                                                    class="flex items-center gap-2 w-full px-3 py-2 text-sm text-red-600 hover:bg-red-50"
                                                    @click="
                                                        open = false;
                                                        deleteId = {{ $bidang->id }};
                                                        deleteNama = '{{ $bidang->nama }}';
                                                        window.dispatchEvent(new CustomEvent('open-confirm', {
                                                            detail: { id: 'hapus-bidang-global' }
                                                        }));
                                                    ">
                                                    <x-heroicon-o-trash class="w-4 h-4" />
                                                    Hapus
                                                </button>
                                            @else
                                                <div
                                                    class="flex items-center gap-2 w-full px-3 py-2 text-sm text-gray-400 cursor-not-allowed">
                                                    <x-heroicon-o-trash class="w-4 h-4" />
                                                    Disabled
                                                </div>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center font-semibold py-10 flex flex-col items-center gap-2">
                        <x-heroicon-o-folder-minus class="w-12 h-12 text-[#CBD5E1]" />
                        <span>Data Bidang belum ada</span>
                    </div>
                @endif

                {{-- CONFIRM MODAL --}}
                <x-confirm-modal id="hapus-bidang-global" title="Hapus Bidang" variant="danger">
                    Yakin ingin menghapus Bidang
                    <span class="font-semibold text-gray-800" x-text="deleteNama"></span>?
                </x-confirm-modal>

                <form :action="'{{ url('admin/bidang') }}/' + deleteId" method="POST"
                    id="delete-form-hapus-bidang-global">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </x-card>
    </div>

    {{-- MODALS --}}

    {{-- CREATE --}}
    <x-modal name="modal-create-Bidang" maxWidth="lg" focusable>
        <div class="p-6">
            <h2 class="text-lg font-semibold mb-4">
                Tambah Bidang
            </h2>

            @if (session('open_modal') === 'modal-create-bidang')
                <x-alert-error />
            @endif

            <form action="{{ route('admin.bidang.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <x-input-label value="Nama Bidang*" />
                    <x-text-input name="nama" class="w-full mt-1" :value="old('nama')" />
                </div>

                <div>
                    <x-input-label value="Kepala Bidang*" />
                    <x-text-input name="kepala" class="w-full mt-1" :value="old('kepala')" />
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <x-button type="button" variant="secondary"
                        @click="window.dispatchEvent(
                            new CustomEvent('close-modal', { detail: 'modal-create-bidang' })
                        )">
                        Batal
                    </x-button>

                    <x-button type="submit" variant="primary">
                        Simpan
                    </x-button>
                </div>
            </form>
        </div>
    </x-modal>
    @foreach ($bidangs as $bidang)
        <x-modal name="modal-edit-bidang-{{ $bidang->id }}" maxWidth="lg" focusable>
            <div class="p-6">

                <h2 class="text-lg font-semibold mb-4">
                    Edit Bidang
                </h2>

                @if (session('open_modal') === 'modal-edit-bidang-' . $bidang->id)
                    <x-alert-error />
                @endif

                <form action="{{ route('admin.bidang.update', $bidang->id) }}" method="POST" class="space-y-4">

                    @csrf
                    @method('PUT')

                    {{-- NAMA --}}
                    <div>
                        <x-input-label value="Nama Bidang*" />
                        <x-text-input name="nama" class="w-full mt-1" :value="old('nama', $bidang->nama)" />
                    </div>

                    {{-- KEPALA --}}
                    <div>
                        <x-input-label value="Kepala Bidang*" />
                        <x-text-input name="kepala" class="w-full mt-1" :value="old('kepala', $bidang->kepala)" />
                    </div>

                    {{-- ACTION --}}
                    <div class="flex justify-end gap-3 pt-4 border-t">

                        <x-button type="button" variant="secondary"
                            @click="window.dispatchEvent(
                            new CustomEvent('close-modal', {
                                detail: 'modal-edit-bidang-{{ $bidang->id }}'
                            })
                        )">
                            Batal
                        </x-button>

                        <x-button type="submit" variant="primary">
                            Simpan
                        </x-button>

                    </div>

                </form>
            </div>
        </x-modal>
    @endforeach
    @if (session('open_modal'))
        <script>
            window.addEventListener('load', () => {
                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: "{{ session('open_modal') }}"
                }));
            });
        </script>
    @endif

</x-appadmin-layout>
