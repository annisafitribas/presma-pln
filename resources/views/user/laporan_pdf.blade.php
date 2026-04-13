<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Presensi</title>

    <style>
        @page {
            size: A4;
            margin: 220px 35px 80px 35px;
        }

        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
        }

        /* HEADER */

        .page-header {
            position: fixed;
            top: -170px;
            left: 0;
            right: 0;
            height: 250px;
        }

        .header-title {
            text-align: center;
        }

        .header-title h1 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .header-title h2 {
            margin: 4px 0 2px;
            font-size: 13px;
            font-weight: bold;
            color: #123B6E;
        }

        .header-title p {
            margin: 0;
            font-size: 12px;
        }

        .header-line {
            border-bottom: 2px solid #123B6E;
            margin: 10px 0 12px 0;
        }

        /* INFO */

        table.info {
            width: 100%;
            border-collapse: collapse;
            font-size: 10.5px;
        }

        table.info td {
            padding: 3px 5px;
        }

        .label {
            width: 18%;
            font-weight: bold;
        }

        .colon {
            width: 2%;
        }

        .value {
            width: 30%;
        }

        /* TABEL */

        table.presensi {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
        }

        table.presensi th,
        table.presensi td {
            border: 1px solid #000;
            padding: 4px 5px;
            font-size: 12px;
            vertical-align: top;
        }

        table.presensi th {
            background: #123B6E;
            color: #fff;
            text-align: center;
        }

        /* TTD */

        .ttd-container {
            margin-top: 40px;
            width: 100%;
            text-align: right;
        }

        .ttd-box {
            width: 230px;
            display: inline-block;
            text-align: left;
        }

        .ttd-name {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="page-header">

        <div class="header-title">
            <h1>LAPORAN PRESENSI PESERTA MAGANG</h1>
            <h2>{{ $konfigurasi->nama_pt ?? '-' }}</h2>
            <p>{{ $konfigurasi->alamat ?? '-' }}</p>
        </div>

        <div class="header-line"></div>

        <table class="info">
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td class="value">{{ $user->name }}</td>

                <td class="label">NIM / NISN</td>
                <td class="colon">:</td>
                <td class="value">{{ $user->profile->nomor_induk ?? '-' }}</td>
            </tr>

            <tr>
                <td class="label">Asal Instansi</td>
                <td class="colon">:</td>
                <td class="value">{{ $user->profile->pendidikan ?? '-' }}</td>

                <td class="label">Jurusan</td>
                <td class="colon">:</td>
                <td class="value">{{ $user->profile->jurusan ?? '-' }}</td>
            </tr>

            <tr>
                <td class="label">Periode Magang</td>
                <td class="colon">:</td>
                <td class="value">
                    {{ optional($user->profile->tgl_masuk)->format('d M Y') ?? '-' }}
                    -
                    {{ optional($user->profile->tgl_keluar)->format('d M Y') ?? '-' }}
                </td>

                <td class="label">Divisi Magang</td>
                <td class="colon">:</td>
                <td class="value">
                    {{ optional($user->profile->bagian)->nama ?? '-' }}
                </td>
            </tr>
        </table>

    </div>

    {{-- ISI --}}
    <table class="presensi">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Masuk</th>
                <th width="15%">Keluar</th>
                <th width="50%">Catatan Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensi as $i => $p)
                <tr>
                    <td align="center">{{ $i + 1 }}</td>
                    <td align="center">
                        {{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}
                    </td>
                    @php
                        $belumVerif = $p->status === 'pending';
                    @endphp

                    @if ($belumVerif)
                        <td align="center">-</td>
                        <td align="center">-</td>
                        <td>
                            Datang terlambat dan belum mendapat verifikasi admin
                        </td>
                    @else
                        <td align="center">{{ $p->jam_masuk ?? '-' }}</td>
                        <td align="center">{{ $p->jam_keluar ?? '-' }}</td>
                        <td>
                            {!! $p->keterangan ? nl2br(e($p->keterangan)) : '-' !!}
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TTD DI AKHIR SAJA --}}
    <div class="ttd-container">
        <div class="ttd-box">
            <p>Banjarbaru, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Pembimbing</p>

            <div class="ttd-name">
                {{ optional($user->profile->pembimbing->user)->name ?? '-' }}
            </div>

            <p>NIP. {{ optional($user->profile->pembimbing)->nip ?? '-' }}</p>
        </div>
    </div>

</body>

</html>
