<x-apppembimbing-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <span class="font-semibold text-[#0D1B2A]">Edit Profil</span>
    </x-slot>

    <x-user-toast />

    <x-card class="p-6 md:p-8 space-y-8">

        {{-- ERROR GLOBAL --}}
        <x-alert-error />

        <form method="POST" action="{{ route('pembimbing.profile.update') }}" enctype="multipart/form-data"
            class="space-y-10">

            @csrf
            @method('PUT')

            {{-- FOTO --}}
            <section class="flex flex-col items-center space-y-3">

                <div class="relative">

                    <div
                        class="w-32 h-32 rounded-full overflow-hidden border-4 border-blue-100 shadow
                               bg-gray-100 flex items-center justify-center">

                        @if ($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" id="previewImg" class="w-full h-full object-cover">
                        @else
                            <x-heroicon-o-user class="w-12 h-12 text-gray-400" />
                        @endif
                    </div>

                    <label
                        class="absolute bottom-1 right-1 bg-[#123B6E] hover:bg-[#0F325C]
                               text-white p-2 rounded-full cursor-pointer shadow transition">
                        <x-heroicon-o-camera class="w-5 h-5" />

                        <input type="file" name="foto" class="hidden" accept="image/*"
                            onchange="
                                    const file = event.target.files[0];
                                    if(file){
                                        document.getElementById('previewImg').src =
                                            URL.createObjectURL(file);
                                    }
                               ">
                    </label>
                </div>

                <p class="text-sm text-gray-500">
                    Klik ikon kamera untuk mengganti foto
                </p>
            </section>


            {{-- DATA PRIBADI --}}
            <section class="space-y-6">
                <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700 border-b pb-2">
                    <x-heroicon-o-identification class="w-5 h-5 text-[#123B6E]" />
                    Data Pribadi
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap*</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            placeholder="Contoh: User"
                            class="mt-1 w-full rounded-lg px-3 py-2 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email*</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            placeholder="Contoh: user@email.com"
                            class="mt-1 w-full rounded-lg px-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin*</label>
                        <select name="gender"
                            class="mt-1 w-full rounded-lg px-3 py-2 border {{ $errors->has('gender') ? 'border-red-500' : 'border-gray-300' }}">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('gender', $user->gender) == 'L' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="P" {{ old('gender', $user->gender) == 'P' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir"
                            value="{{ old('tgl_lahir', optional($user->tgl_lahir)->format('Y-m-d')) }}"
                            class="mt-1 w-full rounded-lg px-3 py-2 border {{ $errors->has('tgl_lahir') ? 'border-red-500' : 'border-gray-300' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">No. HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                            placeholder="Masukkan format angka"
                            class="mt-1 w-full rounded-lg px-3 py-2 border {{ $errors->has('no_hp') ? 'border-red-500' : 'border-gray-300' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat', $user->alamat) }}"
                            placeholder="Contoh: Jl. Panglima Batur"
                            class="mt-1 w-full rounded-lg px-3 py-2 border {{ $errors->has('alamat') ? 'border-red-500' : 'border-gray-300' }}">
                    </div>

                </div>
            </section>


            {{-- DATA PEMBIMBING --}}
            <section class="space-y-6">
                <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700 border-b pb-2">
                    <x-heroicon-o-briefcase class="w-5 h-5 text-[#123B6E]" />
                    Data Kepembimbingan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="text" name="nip"
                            value="{{ old('nip', optional($user->pembimbingProfile)->nip) }}"
                            placeholder="Contoh: 8207022D "
                            class="mt-1 w-full rounded-lg px-3 py-2 border {{ $errors->has('nip') ? 'border-red-500' : 'border-gray-300' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jabatan*</label>
                        <input type="text" name="jabatan"
                            value="{{ old('jabatan', optional($user->pembimbingProfile)->jabatan ?? '') }}"
                            placeholder="Contoh: Staff"
                            class="mt-1 w-full rounded-lg px-3 py-2 border {{ $errors->has('jabatan') ? 'border-red-500' : 'border-gray-300' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bagian*</label>
                        <select name="bagian_id"
                            class="mt-1 w-full rounded-lg px-3 py-2 border {{ $errors->has('bagian_id') ? 'border-red-500' : 'border-gray-300' }}">
                            <option value="">-- Pilih Bagian --</option>
                            @foreach ($bagians as $bagian)
                                <option value="{{ $bagian->id }}"
                                    {{ old('bagian_id', optional($user->pembimbingProfile)->bagian_id ?? '') == $bagian->id ? 'selected' : '' }}>
                                    {{ $bagian->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </section>


            {{-- ACTION --}}
            <div class="flex justify-end gap-3 pt-6 border-t">
                <x-user-button-link href="{{ route('pembimbing.profile.index') }}" variant="secondary">
                    Batal
                </x-user-button-link>

                <x-user-button type="submit">
                    Simpan
                </x-user-button>
            </div>

        </form>

    </x-card>

</x-apppembimbing-layout>
