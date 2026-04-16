<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bidang;

class bidangseeder extends Seeder
{
    public function run(): void
    {
        $bidangs = [
            [
                'nama_bidang'   => 'Keuangan',
                'kepala_bidang' => 'Emy Astuti',
                'nip'           => '19801111 202012 1 001',
            ],
            [
                'nama_bidang'   => 'Sales',
                'kepala_bidang' => 'Muhammad Sigit Kurniawan',
                'nip'           => '19802222 202012 1 002',
            ],
            [
                'nama_bidang'   => 'PP',
                'kepala_bidang' => 'Asterina Azizah',
                'nip'           => '19803333 202012 1 003',
            ],
        ];

        foreach ($bidangs as $b) {
            Bidang::firstOrCreate(
                ['nama_bidang' => $b['nama_bidang']], // kolom UNIQUE
                $b
            );
        }
    }
}
