<x-appadmin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-[#0D1B2A]">
            <span>Pengguna</span>
        </div>
    </x-slot>

    <div class="container mx-auto">
        <x-card class="overflow-visible">

            <div x-data="{ deleteId: null, deleteNama: '' }">

                {{-- HEADER --}}
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                    {{-- TITLE --}}
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-users class="w-6 h-6 text-[#0D1B2A]" />
                        <h2 class="text-lg font-semibold text-[#0D1B2A]">
                            Daftar Pengguna
                        </h2>
                    </div>

                    {{-- FILTER + BUTTON --}}
                    <div class="relative flex items-center gap-4 overflow-visible">

                        {{-- FILTER --}}
                        <div class="relative w-full md:w-64 lg:w-72 md:mr-6">
                            <form method="GET" action="{{ route('admin.pengguna.index') }}">
                                <x-select-box name="role" :value="$role" :options="[
                                    'all' => 'Semua',
                                    'user' => 'Magang',
                                    'admin' => 'Admin',
                                    'pembimbing' => 'Mentor',
                                ]" submit />
                            </form>
                        </div>

                        {{-- BUTTON --}}
                        <x-button-link href="{{ route('admin.pengguna.create') }}" variant="primary"
                            icon="heroicon-o-plus-circle" class="whitespace-nowrap">
                            Tambah
                        </x-button-link>

                    </div>

                </div>

                @if ($users->count())

                    {{--  DESKTOP --}}
                    <div class="hidden md:block -mx-6 relative z-0">
                        <div class="overflow-x-auto px-6">
                            <div class="min-w-[950px]">

                                <x-table class="text-sm w-full">
                                    <thead>
                                        <tr>
                                            <x-table-th align="center" class="w-12">No</x-table-th>
                                            <x-table-th>Nama</x-table-th>
                                            <x-table-th>Email</x-table-th>

                                            @if ($role === 'admin')
                                                <x-table-th>No HP</x-table-th>
                                            @elseif($role === 'pembimbing')
                                                <x-table-th>Bidang</x-table-th>
                                                <x-table-th align="center">Jumlah Peserta</x-table-th>
                                            @elseif($role === 'user')
                                                <x-table-th>Pendidikan</x-table-th>
                                                <x-table-th>Bidang</x-table-th>
                                                <x-table-th>Status</x-table-th>
                                            @else
                                                <x-table-th>Role</x-table-th>
                                            @endif

                                            <x-table-th align="center">Aksi</x-table-th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $user)
                                            @php
                                                $isSelf = auth()->id() === $user->id;
                                                $canDelete = true;
                                                $deleteReason = '';

                                                if ($isSelf) {
                                                    $canDelete = false;
                                                    $deleteReason = 'Tidak bisa hapus diri sendiri';
                                                }

                                                if (
                                                    $user->role === 'pembimbing' &&
                                                    optional($user->pembimbingProfile)->usersDibimbing->count() > 0
                                                ) {
                                                    $canDelete = false;
                                                    $deleteReason = 'Masih memiliki peserta dibimbing';
                                                }

                                                if (
                                                    $user->role === 'user' &&
                                                    optional($user->profile)->status_magang === 'Aktif'
                                                ) {
                                                    $canDelete = false;
                                                    $deleteReason = 'Peserta masih aktif';
                                                }
                                            @endphp

                                            <tr class="hover:bg-[#0D1B2A1A] even:bg-[#F8FAFC] transition">
                                                <x-table-td
                                                    align="center">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</x-table-td>
                                                <x-table-td>{{ $user->name }}</x-table-td>
                                                <x-table-td>{{ $user->email }}</x-table-td>

                                                @if ($role === 'admin')
                                                    <x-table-td>{{ $user->no_hp ?? '-' }}</x-table-td>
                                                @elseif($role === 'pembimbing')
                                                    <x-table-td>
                                                        {{ optional(optional($user->pembimbingProfile)->bidang)->nama ?? '-' }}
                                                    </x-table-td>
                                                    <x-table-td align="center">
                                                        {{ optional($user->pembimbingProfile)->usersDibimbing->count() ?? 0 }}
                                                    </x-table-td>
                                                @elseif($role === 'user')
                                                    <x-table-td>{{ optional($user->profile)->pendidikan ?? '-' }}</x-table-td>
                                                    <x-table-td>{{ optional(optional($user->profile)->bidang)->nama ?? '-' }}</x-table-td>
                                                    <x-table-td>
                                                        <span
                                                            class="font-semibold
                                        {{ optional($user->profile)->status_magang === 'Aktif' ? 'text-green-600' : 'text-gray-500' }}">
                                                            {{ optional($user->profile)->status_magang ?? '-' }}
                                                        </span>
                                                    </x-table-td>
                                                @else
                                                    <x-table-td>{{ ucfirst($user->role) }}</x-table-td>
                                                @endif

                                                {{-- ACTION --}}
                                                <x-table-td align="center">
                                                    <div class="flex items-center justify-center gap-2">

                                                        <a href="{{ route('admin.pengguna.show', $user->id) }}"
                                                            class="p-1.5 rounded-md text-blue-500 hover:bg-blue-500/10">
                                                            <x-heroicon-o-eye class="w-5 h-5" />
                                                        </a>

                                                        <a href="{{ route('admin.pengguna.edit', $user->id) }}"
                                                            class="p-1.5 rounded-md text-yellow-500 hover:bg-yellow-500/10">
                                                            <x-heroicon-o-pencil-square class="w-5 h-5" />
                                                        </a>

                                                        @if ($canDelete)
                                                            <button type="button"
                                                                class="p-1.5 rounded-md text-red-500 hover:bg-red-500/10"
                                                                @click="
                                                                deleteId = {{ $user->id }};
                                                                deleteNama = '{{ $user->name }}';
                                                                window.dispatchEvent(new CustomEvent('open-confirm', {
                                                                    detail: { id: 'hapus-user-global' }
                                                                }));
                                                            ">
                                                                <x-heroicon-o-trash class="w-5 h-5" />
                                                            </button>
                                                        @else
                                                            <span
                                                                class="p-1.5 rounded-md text-gray-400 cursor-not-allowed"
                                                                title="{{ $deleteReason }}">
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

                    {{--  MOBILE --}}
                    <div class="md:hidden space-y-4">

                        @foreach ($users as $user)
                            @php
                                $isSelf = auth()->id() === $user->id;
                                $canDelete = true;
                                $deleteReason = '';

                                if ($isSelf) {
                                    $canDelete = false;
                                    $deleteReason = 'Tidak bisa hapus diri sendiri';
                                }

                                if (
                                    $user->role === 'pembimbing' &&
                                    optional($user->pembimbingProfile)->usersDibimbing->count() > 0
                                ) {
                                    $canDelete = false;
                                    $deleteReason = 'Masih punya peserta';
                                }

                                if ($user->role === 'user' && optional($user->profile)->status_magang === 'Aktif') {
                                    $canDelete = false;
                                    $deleteReason = 'Peserta aktif';
                                }
                            @endphp

                            <div class="bg-white border rounded-2xl p-4 shadow-sm" x-data="{ open: false }">

                                {{-- HEADER --}}
                                <div class="flex justify-between items-start">

                                    <div>
                                        <p class="font-semibold text-sm text-[#0D1B2A]">
                                            {{ $user->name }}
                                            @if ($role === 'user')
                                                <span
                                                    class="ml-2 text-xs font-semibold
                                    {{ optional($user->profile)->status_magang === 'Aktif' ? 'text-green-600' : 'text-red-500' }}">
                                                    {{ optional($user->profile)->status_magang }}
                                                </span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $user->email }}
                                        </p>
                                    </div>

                                    {{-- DOT MENU --}}
                                    <div class="relative">
                                        <button @click="open=!open" class="p-2 rounded-full hover:bg-gray-100">
                                            <x-heroicon-o-ellipsis-vertical class="w-5 h-5" />
                                        </button>

                                        <div x-show="open" @click.away="open=false" x-transition
                                            class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-2xl shadow-xl py-2 z-50">

                                            {{-- LIHAT --}}
                                            <a href="{{ route('admin.pengguna.show', $user->id) }}"
                                                class="flex items-center gap-2 w-full px-3 py-2 text-sm text-blue-600 hover:bg-blue-50">
                                                <x-heroicon-o-eye class="w-4 h-4" />
                                                Lihat
                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.pengguna.edit', $user->id) }}"
                                                class="flex items-center gap-2 w-full px-3 py-2 text-sm text-yellow-600 hover:bg-yellow-50">
                                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                                                Edit
                                            </a>

                                            {{-- DELETE --}}
                                            @if ($canDelete)
                                                <button type="button"
                                                    class="flex items-center gap-2 w-full px-3 py-2 text-sm text-red-600 hover:bg-red-50"
                                                    @click="open = false;deleteId = {{ $user->id }};deleteNama = '{{ $user->name }}';window.dispatchEvent(new CustomEvent('open-confirm', {    detail: { id: 'hapus-user-global' }}));">
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

                                {{-- DETAIL --}}
                                <div class="mt-3 text-xs text-gray-600 space-y-1">

                                    @if ($role === 'admin')
                                        <p>No HP : {{ $user->no_hp ?? '-' }}</p>
                                    @elseif($role === 'pembimbing')
                                        <p>
                                            {{ optional(optional($user->pembimbingProfile)->bidang)->nama ?? '-' }}
                                        </p>
                                        <p>Jumlah Peserta :
                                            {{ optional($user->pembimbingProfile)->usersDibimbing->count() ?? 0 }}
                                        </p>
                                    @elseif($role === 'user')
                                        <p>
                                            {{ optional($user->profile)->pendidikan ?? '-' }}
                                        </p>
                                        <p>Bidang :
                                            {{ optional(optional($user->profile)->bidang)->nama ?? '-' }}
                                        </p>
                                    @else
                                        <p>Role : {{ ucfirst($user->role) }}</p>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-end mt-6 px-6">
                        {{ $users->onEachSide(1)->links() }}
                    </div>
                @else
                    <div class="text-center py-10 text-gray-400">
                        Data pengguna belum ada
                    </div>
                @endif

                {{-- CONFIRM DELETE --}}
                <x-confirm-modal id="hapus-user-global" title="Hapus Pengguna" variant="danger">
                    Yakin ingin menghapus pengguna
                    <span class="font-semibold text-gray-800" x-text="deleteNama"></span>?
                </x-confirm-modal>

                <form :action="'{{ url('admin/pengguna') }}/' + deleteId" method="POST"
                    id="delete-form-hapus-user-global">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </x-card>
    </div>

</x-appadmin-layout>
