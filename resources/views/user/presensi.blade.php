<x-appuser-layout>

    <x-slot name="header">
        <span class="font-semibold text-[#0D1B2A]">Buat Presensi</span>
    </x-slot>

    {{-- USER TOAST (frontend)
    <x-alert-error />
    @if (session('error'))
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <div class="font-semibold mb-1">
                Terjadi kesalahan
            </div>
            <div>
                {{ session('error') }}
            </div>
        </div>
    @endif --}}

    {{-- Data Konfigurasi --}}
    <input type="hidden" id="kantorLat" value="{{ $konfigurasi->kantor_lat }}">
    <input type="hidden" id="kantorLng" value="{{ $konfigurasi->kantor_lng }}">
    <input type="hidden" id="radiusKantor" value="{{ $konfigurasi->radius }}">
    <input type="hidden" id="jamMasukUser" value="{{ $presensiHariIni->jam_masuk ?? '' }}">

    {{-- STATUS --}}
    <input type="hidden" id="sudahMasuk" value="{{ $presensiHariIni?->jam_masuk ? '1' : '0' }}">

    <div class="space-y-4 mb-6">

        {{-- INFO KANTOR --}}
        <div class="bg-white p-6 rounded-2xl shadow space-y-3">

            <p class="font-semibold text-gray-800 flex items-center gap-2">
                <x-heroicon-o-building-office-2 class="w-5 h-5 text-blue-600" />
                {{ $konfigurasi->nama_apk }}
            </p>

            <div class="flex items-center gap-2 text-gray-600 text-sm">
                <x-heroicon-o-scale class="w-5 h-5 text-blue-500" />
                <span>
                    @if (!$konfigurasi->radius || $konfigurasi->radius == 0)
                        Mode WFA (bebas lokasi, namun tetap lakukan pengambilan lokasi)
                    @else
                        Radius Presensi {{ $konfigurasi->radius }} meter
                    @endif
                </span>
            </div>

            <div class="flex items-center gap-2 text-gray-600 text-sm">
                <x-heroicon-o-clock class="w-5 h-5 text-blue-500" />
                <span>
                    {{ $konfigurasi->jam_masuk }} - {{ $konfigurasi->jam_keluar }} WITA
                </span>
            </div>

        </div>

        {{-- STATUS LOKASI --}}
        <div class="bg-white p-6 rounded-2xl shadow space-y-3">

            <p id="statusLokasi" class="font-semibold text-gray-500 flex items-center gap-2">
                <x-heroicon-o-map-pin class="w-5 h-5" />
                Lokasi belum diambil
            </p>

            <div class="flex items-center gap-2 text-gray-600 text-sm">
                <x-heroicon-o-globe-alt class="w-5 h-5 text-blue-500" />
                <span id="latLngText">-</span>
            </div>

            <div class="flex items-center gap-2 text-gray-600 text-sm">
                <x-heroicon-o-arrows-right-left class="w-5 h-5 text-blue-500" />
                <span id="jarakText">-</span>
            </div>

        </div>

        {{-- AMBIL LOKASI --}}
        <button type="button" id="ambilLokasi"
            class="w-full flex items-center justify-center gap-2
                   bg-blue-600 hover:bg-blue-700 text-white
                   py-3 rounded-xl font-semibold transition">
            <x-heroicon-o-map class="w-5 h-5" />
            Ambil Lokasi
        </button>

        {{-- FORM PRESENSI --}}
        <form id="formPresensi" method="POST" action="{{ route('user.presensi.store') }}">
            @csrf

            <input type="hidden" name="latitude" id="lat">
            <input type="hidden" name="longitude" id="lng">

            <div class="flex gap-3 mt-3">

                {{-- MASUK --}}
                <button type="button" id="btnMasuk" data-allowed="{{ $bisaPresensiMasuk ? '1' : '0' }}" disabled
                    class="flex-1 flex items-center justify-center gap-2
                        bg-green-600 text-white py-3 rounded-xl
                        font-semibold opacity-50">
                    <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                    Masuk
                </button>

                {{-- KELUAR --}}
                <button type="button" id="btnKeluar" data-allowed="{{ $bisaPresensiKeluar ? '1' : '0' }}" disabled
                    class="flex-1 flex items-center justify-center gap-2
                        bg-blue-600 text-white py-3 rounded-xl
                        font-semibold opacity-50">
                    <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5" />
                    Keluar
                </button>

                {{-- TIDAK HADIR --}}
                @if ($bolehTidakHadirManual)
                    <button type="button" id="btnAlpha" @if ($presensiHariIni?->jam_masuk) disabled @endif
                        class="flex-1 flex items-center justify-center gap-2 bg-red-600 text-white py-3 rounded-xl font-semibold
                @if ($presensiHariIni?->jam_masuk) opacity-50 cursor-not-allowed @endif">
                        <x-heroicon-o-x-circle class="w-5 h-5" />
                        Absen
                    </button>
                @else
                    <a href="{{ $presensiHariIni?->jam_masuk ? '#' : route('user.pengajuan.index') }}"
                        class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl font-semibold
                        {{ $presensiHariIni?->jam_masuk
                            ? 'bg-gray-400 cursor-not-allowed pointer-events-none'
                            : 'bg-[#123B6E] hover:bg-[#0F325C] text-white' }}">

                        <x-heroicon-o-document-text class="w-5 h-5" />
                        Cuti
                    </a>
                @endif
            </div>
        </form>

        {{-- INFO PRESENSI (MOBILE FRIENDLY) --}}
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4 text-sm text-blue-900 space-y-3">

            <p class="font-semibold flex items-center gap-2">
                <x-heroicon-o-information-circle class="w-5 h-5 text-blue-600" />
                Informasi Presensi
            </p>

            <ul class="space-y-2">

                <li class="flex items-start gap-2">
                    <span>
                        Tekan <b>Ambil Lokasi</b> dan pastikan status <b>valid</b>.
                    </span>
                </li>

                <li class="flex items-start gap-2">
                    <span>
                        <b>Masuk</b> hanya dapat dilakukan jika berada dalam radius kantor.
                    </span>
                </li>

                <li class="flex items-start gap-2">
                    <span>
                        Presensi <b>Masuk</b> setelah jam {{ $konfigurasi->jam_masuk }}
                        akan dianggap <b>terlambat</b> dan wajib mengisi alasan.
                    </span>
                </li>

                <li class="flex items-start gap-2">
                    <span>
                        <b>Keluar</b> setelah presensi masuk dengan mengisi ringkasan pekerjaan.
                    </span>
                </li>

                <li class="flex items-start gap-2">
                    <span>
                        <b>Alpha</b> hanya sebelum presensi masuk, tanpa lokasi
                        (pilih <b>Izin</b> atau <b>Sakit</b>). Satu bulan boleh 1x
                    </span>
                </li>
                <li class="flex items-start gap-2">
                    <span>
                        Jika sudah menggunakan jatah ketidakhadiran dalam bulan yang sama, maka klik tombol "Cuti"
                    </span>
                </li>

            </ul>
        </div>

    </div>

    {{-- MODAL KETERANGAN --}}
    <div id="modalKeterangan" class="fixed inset-0 hidden z-[999]">

        <!-- BACKDROP -->
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"
            onclick="document.getElementById('modalKeterangan').classList.add('hidden')">
        </div>

        <!-- MODAL CONTENT -->
        <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
            <div class="bg-white p-6 rounded-xl w-full max-w-md space-y-4 shadow-xl">

                <h3 id="judulModal" class="font-semibold text-lg">Keterangan</h3>

                <p id="errorModal" class="hidden text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-2">
                </p>

                <div id="opsiStatus" class="flex gap-3">
                    <button type="button" id="btnIzin"
                        class="flex-1 py-2 rounded-xl border border-yellow-400 text-yellow-600">
                        Izin
                    </button>
                    <button type="button" id="btnSakit"
                        class="flex-1 py-2 rounded-xl border border-red-400 text-red-600">
                        Sakit
                    </button>
                </div>

                <textarea id="inputKeterangan" class="w-full border rounded-xl p-2" placeholder="Silahkan masukkan alasan"></textarea>

                <div class="flex justify-end gap-2">
                    <button type="button" id="batalKeterangan"
                        class="px-4 py-2 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-xl">
                        Batal
                    </button>
                    <button type="button" id="lanjutKeterangan"
                        class="px-4 py-2 bg-[#123B6E] text-white hover:bg-[#0F325C] rounded-xl">
                        Lanjut
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div id="modalDurasi" class="fixed inset-0 hidden z-[999]">

        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"
            onclick="document.getElementById('modalDurasi').classList.add('hidden')">
        </div>

        <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
            <div class="bg-white p-6 rounded-xl w-full max-w-md space-y-4 shadow-xl">

                <h3 class="font-semibold text-lg text-red-600">
                    Konfirmasi Presensi
                </h3>

                <p class="text-sm text-gray-700">
                    Durasi kerja Anda kurang dari setengah jam kerja.
                    Jika dilanjutkan, presensi akan dianggap <b>Alpha</b>.
                    Apakah Anda yakin ingin melanjutkan?
                </p>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modalDurasi').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-200 rounded-xl">
                        Batal
                    </button>

                    <button type="button" id="confirmDurasi" class="px-4 py-2 bg-red-600 text-white rounded-xl">
                        Ya, Lanjutkan
                    </button>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* 
               STATE
             */
            let lokasiValid = false;
            let presensiType = '';
            let statusTidakHadir = '';

            /* 
               ELEMENT
             */
            const ambil = document.getElementById('ambilLokasi');
            const btnMasuk = document.getElementById('btnMasuk');
            const btnKeluar = document.getElementById('btnKeluar');
            const btnAlpha = document.getElementById('btnAlpha');

            const kantorLat = parseFloat(document.getElementById('kantorLat').value);
            const kantorLng = parseFloat(document.getElementById('kantorLng').value);
            const radiusKantor = parseFloat(document.getElementById('radiusKantor').value);
            const isWfa = !radiusKantor || radiusKantor === 0;

            const sudahMasuk = document.getElementById('sudahMasuk').value === '1';
            const bolehMasuk = btnMasuk.dataset.allowed === '1';
            const bolehKeluar = btnKeluar.dataset.allowed === '1';

            const statusLokasi = document.getElementById('statusLokasi');
            const latLngText = document.getElementById('latLngText');
            const jarakText = document.getElementById('jarakText');

            const modal = document.getElementById('modalKeterangan');
            const inputKet = document.getElementById('inputKeterangan');

            const opsiStatus = document.getElementById('opsiStatus');
            const judulModal = document.getElementById('judulModal');
            const errorBox = document.getElementById('errorModal');

            const jamMasukUser = document.getElementById('jamMasukUser').value;
            const modalDurasi = document.getElementById('modalDurasi');
            const confirmDurasi = document.getElementById('confirmDurasi');

            const btnIzin = document.getElementById('btnIzin');
            const btnSakit = document.getElementById('btnSakit');
            const btnBatal = document.getElementById('batalKeterangan');
            const btnLanjut = document.getElementById('lanjutKeterangan');


            /* 
               HITUNG JARAK
             */
            function hitungJarak(lat1, lon1, lat2, lon2) {

                const R = 6371000;

                const dLat = (lat2 - lat1) * Math.PI / 180;
                const dLon = (lon2 - lon1) * Math.PI / 180;

                const a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(lat1 * Math.PI / 180) *
                    Math.cos(lat2 * Math.PI / 180) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);

                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

                return R * c;
            }


            /* 
               UPDATE BUTTON
             */
            function updateButtonState() {

                btnMasuk.disabled = true;
                btnKeluar.disabled = true;

                btnMasuk.classList.add('opacity-50');
                btnKeluar.classList.add('opacity-50');

                if (!lokasiValid) return;

                // MASUK: hanya kalau BELUM masuk
                if (!sudahMasuk && bolehMasuk) {
                    btnMasuk.disabled = false;
                    btnMasuk.classList.remove('opacity-50');
                }

                // KELUAR: hanya kalau SUDAH masuk
                if (sudahMasuk && bolehKeluar) {
                    btnKeluar.disabled = false;
                    btnKeluar.classList.remove('opacity-50');
                }
            }

            /* 
               AMBIL LOKASI
             */
            ambil.addEventListener('click', function() {

                if (!navigator.geolocation) {
                    alert('Geolocation tidak didukung browser ini');
                    return;
                }

                ambil.disabled = true;
                ambil.innerText = "Mengambil lokasi...";

                navigator.geolocation.getCurrentPosition(function(position) {

                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;

                    latLngText.innerText = lat.toFixed(8) + ', ' + lng.toFixed(8);

                    const jarak = hitungJarak(kantorLat, kantorLng, lat, lng);

                    jarakText.innerText = Math.round(jarak) + " meter";

                    if (isWfa) {

                        lokasiValid = true;

                        statusLokasi.innerHTML =
                            '<span class="text-blue-600 font-semibold">✅ Mode WFA (bebas lokasi)</span>';

                    } else if (jarak <= radiusKantor) {

                        lokasiValid = true;

                        statusLokasi.innerHTML =
                            '<span class="text-green-600 font-semibold">✅ Dalam radius kantor</span>';

                    } else {

                        lokasiValid = false;

                        statusLokasi.innerHTML =
                            '<span class="text-red-600 font-semibold">❌ Di luar radius kantor</span>';
                    }

                    updateButtonState();

                    ambil.innerText = "Ambil Lokasi ulang";
                    ambil.disabled = false;

                }, function() {

                    alert("Gagal mengambil lokasi");

                    ambil.innerText = "Ambil Lokasi ulang";
                    ambil.disabled = false;

                }, {
                    enableHighAccuracy: true
                });

                /* 
                   AUTO NUMBER RINGKASAN PEKERJAAN
                 */
                const textarea = document.getElementById('inputKeterangan');

                if (textarea) {

                    textarea.addEventListener('keydown', function(e) {

                        if (presensiType !== 'keluar') return;
                        // hanya aktif saat modal keluar

                        if (e.key === 'Enter' && !e.shiftKey) {

                            e.preventDefault();

                            let lines = this.value.split(/\r?\n/).filter(line => line.trim() !==
                                '');

                            if (lines.length === 0) {
                                this.value = "1. ";
                                return;
                            }

                            const firstLineNumbered = /^\d+\.\s/.test(lines[0]);

                            if (!firstLineNumbered) {

                                lines = lines.map((line, index) => {
                                    return (index + 1) + ". " + line.replace(/^\d+\.\s/,
                                        '');
                                });

                                this.value = lines.join('\n') + "\n" + (lines.length + 1) + ". ";

                            } else {

                                this.value += "\n" + (lines.length + 1) + ". ";

                            }

                        }

                    });

                }
            });


            /* 
               RESET MODAL
             */
            function resetModal() {

                statusTidakHadir = '';

                inputKet.value = '';

                errorBox.classList.add('hidden');

                btnIzin.classList.remove('bg-yellow-100');
                btnSakit.classList.remove('bg-red-100');
            }


            /* 
               PILIH IZIN / SAKIT
             */
            btnIzin.addEventListener('click', function() {

                statusTidakHadir = 'izin';

                btnIzin.classList.add('bg-yellow-100');
                btnSakit.classList.remove('bg-red-100');
            });

            btnSakit.addEventListener('click', function() {

                statusTidakHadir = 'sakit';

                btnSakit.classList.add('bg-red-100');
                btnIzin.classList.remove('bg-yellow-100');
            });


            /* 
               MASUK
             */
            btnMasuk.addEventListener('click', function() {

                if (btnMasuk.disabled) return;

                presensiType = 'masuk';

                injectHidden('type', 'masuk');

                document.getElementById('formPresensi').submit();
            });


            /* 
               Alpha
             */
            if (btnAlpha) {

                btnAlpha.addEventListener('click', function() {

                    if (sudahMasuk) return;

                    presensiType = 'alpha';

                    resetModal();

                    judulModal.innerText = 'Keterangan Tidak Hadir';

                    opsiStatus.style.display = 'flex';

                    modal.classList.remove('hidden');
                });
            }


            /* 
               KELUAR
             */
            btnKeluar.addEventListener('click', function() {

                presensiType = 'keluar';

                if (!jamMasukUser) {
                    alert('Kamu belum presensi masuk');
                    return;
                }

                const now = new Date();
                const masuk = new Date();

                const [h, m, s] = jamMasukUser.split(':');
                masuk.setHours(h, m, s, 0);

                const durasiMenit = (now - masuk) / 60000;

                if (durasiMenit < 30) {
                    modalDurasi.classList.remove('hidden');
                    return;
                }

                resetModal();

                judulModal.innerText = 'Ringkasan Pekerjaan Hari Ini';
                opsiStatus.style.display = 'none';
                modal.classList.remove('hidden');

            });


            /* 
               BATAL MODAL
             */
            btnBatal.addEventListener('click', function() {

                modal.classList.add('hidden');
            });


            btnLanjut.addEventListener('click', function() {

                errorBox.classList.add('hidden');
                if (presensiType === 'alpha') {

                    if (!statusTidakHadir) {
                        errorBox.innerText = "Pilih jenis ketidakhadiran";
                        errorBox.classList.remove('hidden');
                        return;
                    }

                    if (inputKet.value.trim() === '') {
                        errorBox.innerText = "Alasan wajib diisi";
                        errorBox.classList.remove('hidden');
                        return;
                    }

                    injectHidden('type', 'alpha');
                    injectHidden('status', statusTidakHadir);
                    injectHidden('keterangan', inputKet.value);
                }

                if (presensiType === 'masuk') {

                    if (inputKet.value.trim() === '') {

                        errorBox.innerText = "Alasan keterlambatan wajib diisi";
                        errorBox.classList.remove('hidden');
                        return;
                    }

                    injectHidden('alasan', inputKet.value);
                    injectHidden('type', 'masuk');
                }

                if (presensiType === 'keluar') {

                    if (!document.getElementById('lat').value) {

                        errorBox.innerText = "Lokasi belum diambil";
                        errorBox.classList.remove('hidden');
                        return;
                    }

                    injectHidden('type', 'keluar'); //  WAJIB
                    injectHidden('keterangan', inputKet.value);
                }

                if (presensiType === 'alpha') {

                    injectHidden('type', 'alpha');
                    injectHidden('status', statusTidakHadir);
                    injectHidden('keterangan', inputKet.value);
                }

                modal.classList.add('hidden');
                document.getElementById('formPresensi').submit();
            });

            function injectHidden(name, value) {

                document.querySelectorAll(`[name="${name}"]`).forEach(el => el.remove());
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                document.getElementById('formPresensi').appendChild(input);
            }

            @if (session('telat'))

                presensiType = 'masuk';

                resetModal();

                judulModal.innerText = 'Alasan Keterlambatan';

                opsiStatus.style.display = 'none';

                modal.classList.remove('hidden');

                injectHidden('type', 'masuk');

                //  penting: ambil lokasi lagi
                document.getElementById('ambilLokasi').click();
            @endif
            confirmDurasi.addEventListener('click', function() {

                modalDurasi.classList.add('hidden');

                resetModal();

                judulModal.innerText = 'Ringkasan Pekerjaan Hari Ini';

                opsiStatus.style.display = 'none';

                modal.classList.remove('hidden');

            });

        });
    </script>
</x-appuser-layout>
