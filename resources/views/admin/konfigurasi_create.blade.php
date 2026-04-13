<x-appadmin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#0D1B2A]">
            Buat Data Konfigurasi
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <x-card>

            <x-alert-error />

            <form action="{{ route('admin.konfigurasi.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-8">
                @csrf


                {{-- IDENTITAS KANTOR --}}
                <div>
                    <h3 class="flex items-center gap-2 text-lg font-semibold text-gray-800 border-b -mt-8 pb-2">
                        <x-heroicon-o-building-office class="w-5 h-5 text-indigo-600" />
                        Identitas Kantor
                    </h3>

                    <div class="space-y-4 mt-4">

                        {{-- Logo --}}
                        <div x-data="{ preview: null }">
                            <x-input-label value="Logo" />
                            <img x-show="preview" :src="preview" class="h-20 mb-2 rounded border">
                            <x-text-input type="file" name="logo" class="w-full mt-1" accept="image/*"
                                x-on:change="preview = URL.createObjectURL($event.target.files[0])" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label value="Nama PT*" />
                                <x-text-input name="nama_pt" class="w-full mt-1"
                                    placeholder="PT. PLN (Persero) ULP Banjarbaru" :value="old('nama_pt')" />
                            </div>

                            <div>
                                <x-input-label value="Nama Aplikasi*" />
                                <x-text-input name="nama_apk" class="w-full mt-1" placeholder="APM" :value="old('nama_apk')" />
                            </div>
                        </div>

                    </div>
                </div>



                {{-- KONTAK & LOKASI --}}
                <div>
                    <h3 class="flex items-center gap-2 text-lg font-semibold text-gray-800 border-b pb-2">
                        <x-heroicon-o-map class="w-5 h-5 text-indigo-600" />
                        Kontak & Lokasi
                    </h3>

                    <div class="mt-4 space-y-4">

                        {{-- Koordinat --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label value="Latitude*" />
                                <x-text-input type="number" step="any" name="kantor_lat" class="w-full mt-1"
                                    placeholder="-3.12457854" :value="old('kantor_lat')" />
                            </div>

                            <div>
                                <x-input-label value="Longitude*" />
                                <x-text-input type="number" step="any" name="kantor_lng" class="w-full mt-1"
                                    placeholder="114.21452154" :value="old('kantor_lng')" />
                            </div>

                            <div>
                                <x-input-label value="Radius Absen ('0' untuk mode WFA)*" />
                                <x-text-input type="number" name="radius" class="w-full mt-1" :value="old('radius', 100)" />
                            </div>
                        </div>

                        {{-- Kontak --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <div>
                                <x-input-label value="WhatsApp*" />
                                <div class="relative mt-1">
                                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400 text-sm">
                                        https://wa.me/
                                    </span>
                                    <x-text-input name="wa_link" class="w-full pl-28" placeholder="628123456789"
                                        :value="old('wa_link')" />
                                </div>
                            </div>

                            <div>
                                <x-input-label value="Instagram" />
                                <div class="relative mt-1">
                                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400 text-sm">
                                        https://instagram.com/
                                    </span>
                                    <x-text-input name="ig_link" class="w-full pl-40" placeholder="username"
                                        :value="old('ig_link')" />
                                </div>
                            </div>

                            {{-- Maps --}}
                            <div>
                                <x-input-label value="Link Google Maps" />
                                <x-text-input name="link_maps" class="w-full mt-1"
                                    placeholder="https://www.google.com/maps/..." :value="old('link_maps')" />
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div>
                            <x-input-label value="Alamat" />
                            <textarea name="alamat" rows="3"
                                class="w-full mt-1 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Jl. Panglima Batur No.10">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- JAM OPERASIONAL --}}
                <div>
                    <h3 class="flex items-center gap-2 text-lg font-semibold text-gray-800 border-b pb-2">
                        <x-heroicon-o-clock class="w-5 h-5 text-indigo-600" />
                        Jam Operasional
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mt-4">

                        <div>
                            <x-input-label value="Jam Masuk*" />
                            <x-text-input type="time" step="1" name="jam_masuk" class="w-full mt-1 text-sm"
                                :value="old('jam_masuk')" />
                        </div>

                        <div>
                            <x-input-label value="Jam Keluar*" />
                            <x-text-input type="time" step="1" name="jam_keluar" class="w-full mt-1 text-sm"
                                :value="old('jam_keluar')" />
                        </div>

                        <div>
                            <x-input-label value="Jam Istirahat Mulai*" />
                            <x-text-input type="time" step="1" name="mulai_istirahat"
                                class="w-full mt-1 text-sm" :value="old('mulai_istirahat')" />
                        </div>

                        <div>
                            <x-input-label value="Jam Istirahat Selesai*" />
                            <x-text-input type="time" step="1" name="selesai_istirahat"
                                class="w-full mt-1 text-sm" :value="old('selesai_istirahat')" />
                        </div>

                    </div>
                </div>

                {{-- HARI KERJA --}}
                <div>
                    <h3 class="flex items-center gap-2 text-lg font-semibold text-gray-800 border-b pb-2">
                        <x-heroicon-o-calendar-days class="w-5 h-5 text-indigo-600" />
                        Hari Kerja
                    </h3>

                    @php
                        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
                        $selected = old('hari_kerja', []);
                    @endphp

                    <div class="mt-4 space-y-3">

                        <div class="flex flex-col gap-2">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="status_hari" value="libur"
                                    class="text-red-600 focus:ring-red-500" {{ empty($selected) ? 'checked' : '' }}
                                    onclick="toggleHari(true)">
                                <span class="text-red-600 text-sm font-medium">
                                    Libur (Tidak ada hari kerja)
                                </span>
                            </label>

                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="status_hari" value="aktif"
                                    class="text-blue-600 focus:ring-blue-500" {{ !empty($selected) ? 'checked' : '' }}
                                    onclick="toggleHari(false)">
                                <span class="text-sm font-medium">
                                    Pilih Hari Kerja
                                </span>
                            </label>
                        </div>

                        <div id="hariWrapper" class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-3 border-t">
                            @foreach ($days as $day)
                                <label class="flex items-center gap-2 text-sm cursor-pointer">
                                    <input type="checkbox" name="hari_kerja[]" value="{{ $day }}"
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                        {{ in_array($day, $selected) ? 'checked' : '' }}>
                                    <span>{{ ucfirst($day) }}</span>
                                </label>
                            @endforeach
                        </div>

                    </div>
                </div>



                {{-- ATURAN PRESENSI --}}
                <div>
                    <h3 class="flex items-center gap-2 text-lg font-semibold text-gray-800 border-b pb-2">
                        <x-heroicon-o-document-text class="w-5 h-5 text-indigo-600" />
                        Aturan Presensi
                    </h3>

                    <div class="mt-4">
                        <textarea id="aturan_presensi" name="aturan_presensi" rows="4"
                            class="w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Contoh: Izin tanpa pengajuan hanya 1 hari">{{ old('aturan_presensi') }}</textarea>
                    </div>
                </div>



                {{-- AKSI --}}
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <x-button-link href="{{ route('admin.konfigurasi.index') }}" variant="secondary">
                        Batal
                    </x-button-link>

                    <x-button type="submit" variant="primary">
                        Simpan
                    </x-button>
                </div>

            </form>
        </x-card>
    </div>

    <script>
        function toggleHari(isLibur) {
            const checkboxes = document.querySelectorAll('input[name="hari_kerja[]"]');

            checkboxes.forEach(cb => {
                if (isLibur) {
                    cb.checked = false;
                    cb.disabled = true;
                } else {
                    cb.disabled = false;
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function() {

            const textarea = document.getElementById('aturan_presensi');
            if (!textarea) return;

            textarea.addEventListener('keydown', function(e) {

                if (e.key === 'Enter') {
                    e.preventDefault();

                    let lines = this.value.split(/\r?\n/).filter(line => line.trim() !== '');

                    if (lines.length === 0) {
                        this.value = "1. ";
                        return;
                    }

                    // cek apakah sudah bernomor
                    const isNumbered = /^\d+\.\s/.test(lines[0]);

                    if (!isNumbered) {
                        // format ulang semua baris
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
    </script>

</x-appadmin-layout>
