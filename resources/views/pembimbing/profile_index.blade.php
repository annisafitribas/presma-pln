<x-apppembimbing-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <span class="font-semibold text-[#0D1B2A]">Profil Saya</span>
    </x-slot>
    <x-user-toast />

    @if (session('success'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('user-toast', {
                    detail: {
                        title: 'Berhasil',
                        message: "{{ session('success') }}"
                    }
                }));
            });
        </script>
    @endif
    <div class="space-y-6 mb-6">

        {{-- PROFIL UTAMA --}}
        <x-card class="relative">

            {{-- EDIT BUTTON --}}
            <div class="flex justify-end">
                <x-user-button-link href="{{ route('pembimbing.profile.edit') }}" icon="heroicon-o-pencil" size="sm">
                    Edit
                </x-user-button-link>
            </div>

            {{-- CONTENT --}}
            <div class="flex flex-col items-center space-y-3 mt-4 text-center">

                <div
                    class="w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden
                           border-4 border-blue-100 shadow bg-gray-100
                           flex items-center justify-center">

                    @if ($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="Foto {{ $user->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <x-heroicon-o-user class="w-14 h-14 text-gray-400" />
                    @endif
                </div>

                <div>
                    <h2 class="text-lg md:text-xl font-bold text-gray-800">
                        {{ $user->name }}
                    </h2>

                    <span
                        class="inline-block mt-1 px-4 py-1 text-sm rounded-full
                               bg-blue-50 text-blue-700 font-semibold">
                        Pembimbing
                    </span>
                </div>

            </div>
        </x-card>


        {{-- DATA PRIBADI --}}
        <x-card class="space-y-4">
            <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                <x-heroicon-o-identification class="w-5 h-5 text-blue-600" />
                Data Pribadi
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

                <x-show-item label="Nama Lengkap" :value="$user->name" />
                <x-show-item label="Email" :value="$user->email" />
                <x-show-item label="Jenis Kelamin" :value="$user->gender === 'L' ? 'Laki-laki' : ($user->gender === 'P' ? 'Perempuan' : '-')" />
                <x-show-item label="Tanggal Lahir" :value="optional($user->tgl_lahir)->format('d-m-Y') ?? '-'" />
                <x-show-item label="No. HP" :value="$user->no_hp ?? '-'" />
                <x-show-item label="Alamat" :value="$user->alamat ?? '-'" />

            </div>
        </x-card>


        {{-- DATA KEPEMBIMBINGAN --}}
        @if ($user->pembimbingProfile)
            <x-card class="space-y-4">
                <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                    <x-heroicon-o-briefcase class="w-5 h-5 text-blue-600" />
                    Data Kepembimbingan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

                    <x-show-item label="NIP" :value="$user->pembimbingProfile->nip ?? '-'" />

                    <x-show-item label="Jabatan" :value="$user->pembimbingProfile->jabatan ?? '-'" />

                    <x-show-item label="Bagian" :value="optional($user->pembimbingProfile->bagian)->nama ?? '-'" />

                    <x-show-item label="Jumlah Peserta Dibimbing" :value="$user->pembimbingProfile->usersDibimbing()->count() . ' peserta'" />

                </div>
            </x-card>
        @endif


        {{-- KEAMANAN AKUN --}}
        <x-card class="space-y-4">
            <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                <x-heroicon-o-lock-closed class="w-5 h-5 text-blue-600" />
                Keamanan Akun
            </h3>

            <x-show-item label="Password" value="********" />

            <x-user-button variant="secondary" icon="heroicon-o-key"
                x-on:click="$dispatch('open-modal', 'change-password')">
                Ubah Password
            </x-user-button>
        </x-card>


        {{-- MODAL PASSWORD --}}
        <x-modal name="change-password" :show="session('open_password_modal')" maxWidth="md" focusable>

            <div class="p-6">

                {{-- HEADER --}}
                <div class="space-y-1 mb-2">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Ubah Password
                        </h3>

                        <button type="button" x-on:click="$dispatch('close-modal', 'change-password')">
                            <x-heroicon-o-x-mark class="w-5 h-5 text-gray-500" />
                        </button>
                    </div>

                    <p class="text-xs text-gray-500">
                        Password minimal 6 karakter.
                    </p>
                </div>

                {{-- CONTENT --}}
                <div class="mt-5 space-y-4">

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="rounded-lg bg-red-50 border border-red-200 p-3 text-sm text-red-600">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form method="POST" action="{{ route('pembimbing.profile.password.update') }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        {{-- Password Lama --}}
                        <div>
                            <label class="text-sm text-gray-600">
                                Password Lama
                            </label>
                            <input type="password" name="current_password" value="{{ old('current_password') }}"
                                class="w-full mt-1 rounded-lg px-3 py-2 border
                                {{ $errors->has('current_password') ? 'border-red-500' : 'border-gray-300' }}">
                        </div>

                        {{-- Password Baru --}}
                        <div>
                            <label class="text-sm text-gray-600">
                                Password Baru
                            </label>
                            <input type="password" name="password" value="{{ old('password') }}"
                                class="w-full mt-1 rounded-lg px-3 py-2 border
                                {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}">
                        </div>

                        {{-- Konfirmasi --}}
                        <div>
                            <label class="text-sm text-gray-600">
                                Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation"
                                value="{{ old('password_confirmation') }}"
                                class="w-full mt-1 rounded-lg px-3 py-2 border
                                {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300' }}">
                        </div>

                        {{-- ACTION --}}
                        <div class="flex justify-end gap-2 pt-4 border-t">
                            <x-user-button type="button" variant="secondary"
                                x-on:click="$dispatch('close-modal', 'change-password')">
                                Batal
                            </x-user-button>

                            <x-user-button type="submit">
                                Simpan
                            </x-user-button>
                        </div>

                    </form>
                </div>
            </div>

        </x-modal>

    </div>

</x-apppembimbing-layout>
