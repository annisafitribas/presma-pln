<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted' => ':attribute harus disetujui.',
    'active_url' => ':attribute bukan URL yang valid.',
    'after' => ':attribute harus berupa tanggal setelah :date.',
    'after_or_equal' => ':attribute harus berupa tanggal yang sama atau setelah hari ini.',
    'alpha' => ':attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':attribute hanya boleh berisi huruf, angka, strip, dan underscore.',
    'alpha_num' => ':attribute hanya boleh berisi huruf dan angka.',
    'array' => ':attribute harus berupa array.',
    'before' => ':attribute harus berupa tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus berupa tanggal yang sama atau sebelum :date.',
    'between' => [
        'numeric' => ':attribute harus antara :min sampai :max.',
        'file' => ':attribute harus antara :min sampai :max KB.',
        'string' => ':attribute harus antara :min sampai :max karakter.',
        'array' => ':attribute harus antara :min sampai :max item.',
    ],
    'boolean' => ':attribute harus bernilai true atau false.',
    'confirmed' => 'Konfirmasi :attribute tidak sesuai.',
    'date' => ':attribute harus berupa tanggal yang valid.',
    'date_equals' => ':attribute harus berupa tanggal yang sama dengan :date.',
    'date_format' => ':attribute tidak sesuai format :format.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus terdiri dari :digits digit.',
    'digits_between' => ':attribute harus terdiri dari :min sampai :max digit.',
    'email' => ':attribute harus berupa email yang valid.',
    'ends_with' => ':attribute harus diakhiri dengan salah satu: :values.',
    'exists' => ':attribute tidak valid atau tidak ditemukan.',
    'file' => ':attribute harus berupa file.',
    'filled' => ':attribute wajib diisi.',
    'gt' => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file' => ':attribute harus lebih besar dari :value KB.',
        'string' => ':attribute harus lebih besar dari :value karakter.',
        'array' => ':attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => ':attribute harus lebih besar atau sama dengan :value.',
        'file' => ':attribute harus lebih besar atau sama dengan :value KB.',
        'string' => ':attribute harus lebih besar atau sama dengan :value karakter.',
        'array' => ':attribute harus memiliki :value item atau lebih.',
    ],
    'image' => ':attribute harus berupa file gambar.',
    'in' => ':attribute tidak valid.',
    'integer' => ':attribute harus berupa angka.',
    'ip' => ':attribute harus berupa IP yang valid.',
    'ipv4' => ':attribute harus berupa IPv4 yang valid.',
    'ipv6' => ':attribute harus berupa IPv6 yang valid.',
    'json' => ':attribute harus berupa JSON yang valid.',
    'lt' => [
        'numeric' => ':attribute harus lebih kecil dari :value.',
        'file' => ':attribute harus lebih kecil dari :value KB.',
        'string' => ':attribute harus lebih kecil dari :value karakter.',
        'array' => ':attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => ':attribute harus lebih kecil atau sama dengan :value.',
        'file' => ':attribute harus lebih kecil atau sama dengan :value KB.',
        'string' => ':attribute harus lebih kecil atau sama dengan :value karakter.',
        'array' => ':attribute tidak boleh lebih dari :value item.',
    ],
    'max' => [
        'numeric' => ':attribute maksimal :max.',
        'file' => ':attribute maksimal :max KB.',
        'string' => ':attribute maksimal :max karakter.',
        'array' => ':attribute maksimal :max item.',
    ],
    'mimes' => ':attribute harus berformat: :values.',
    'mimetypes' => ':attribute harus berformat: :values.',
    'min' => [
        'numeric' => ':attribute minimal :min.',
        'file' => ':attribute minimal :min KB.',
        'string' => ':attribute minimal :min karakter.',
        'array' => ':attribute minimal :min item.',
    ],
    'not_in' => ':attribute tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => ':attribute harus berupa angka.',
    'password' => 'Password tidak sesuai.',
    'present' => ':attribute harus ada.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => ':attribute wajib diisi.',
    'required_if' => ':attribute wajib diisi.',
    'required_unless' => ':attribute wajib diisi.',
    'required_with' => ':attribute wajib diisi.',
    'required_with_all' => ':attribute wajib diisi.',
    'required_without' => ':attribute wajib diisi.',
    'required_without_all' => ':attribute wajib diisi.',
    'same' => ':attribute harus sama dengan :other.',
    'size' => [
        'numeric' => ':attribute harus berukuran :size.',
        'file' => ':attribute harus berukuran :size KB.',
        'string' => ':attribute harus berukuran :size karakter.',
        'array' => ':attribute harus berisi :size item.',
    ],
    'string' => ':attribute harus berupa teks.',
    'unique' => ':attribute sudah digunakan. Silakan gunakan data lain.',
    'url' => ':attribute harus berupa tautan yang valid.',

    'custom' => [
        'tgl_mulai' => [
            'overlap' => 'Tanggal yang diajukan bertabrakan dengan pengajuan sebelumnya.',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [

        // auth
        'email'     => 'Email',
        'password'  => 'Password',

        // user (umum)
        'name'      => 'Nama lengkap',
        'role'      => 'Role',
        'gender'    => 'Jenis kelamin',
        'tgl_lahir' => 'Tanggal lahir',
        'no_hp'     => 'Nomor HP',
        'alamat'    => 'Alamat',
        'foto'      => 'Foto',

        // kantor
        'nama_apk'  => 'Nama aplikasi',
        'nama_pt'   => 'Nama perusahaan',
        'alamat'    => 'Alamat',
        'logo'      => 'Logo kantor',
        'link_maps' => 'Link Google Maps',
        'wa_link'   => 'Link WhatsApp',
        'ig_link'   => 'Link Instagram',
        'hari_kerja' => 'Hari Kerja',
        'jam_masuk' => 'Jam Masuk',
        'jam_keluar' => 'Jam Keluar',
        '_telat' => 'Jam  Telat',
        'mulai_istirahat' => 'Jam Istirahat Mulai',
        'selesai_istirahat' => 'Jam Istirahat Selesai',
        'kantor_lat' => 'Latitude',
        'kantor_lng' => 'Longitude',
        'radius' => 'Radius Presensi',

        // Bidang
        'nama'      => 'Nama bidang',
        'kepala'    => 'Kepala bidang',

        // pembimbing
        'pembimbing.nip'       => 'NIP',
        'pembimbing.jabatan'   => 'Jabatan',
        'pembimbing.bidang_id' => 'Bidang pembimbing',

        // user magang
        'user.nomor_induk'   => 'Nomor induk',
        'user.tingkatan'     => 'Tingkatan',
        'user.pendidikan'    => 'Asal pendidikan',
        'user.kelas'         => 'Kelas / Semester',
        'user.jurusan'       => 'Jurusan',
        'user.bidang_id'     => 'Bidang magang',
        'user.pembimbing_id' => 'Pembimbing',
        'user.tgl_masuk'     => 'Tanggal masuk',
        'user.tgl_keluar'    => 'Tanggal keluar',

        // pengjuan oleh user
        'tgl_mulai'   => 'Tanggal mulai',
        'tgl_selesai' => 'Tanggal selesai',
        'keterangan'      => 'Keterangan',
        'bukti' => 'Bukti (PDF/JPG/PNG)',
        'jenis' => 'Jenis pengajuan',

        'status' => 'Status keputusan',
        'catatan_admin' => 'Catatan admin',

    ],

];
