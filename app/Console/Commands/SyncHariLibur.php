<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\HariLibur;

class SyncHariLibur extends Command
{
    protected $signature = 'sync:harilibur';
    protected $description = 'Sync hari libur dari API';

    public function handle()
    {
        $tahun = now()->year;

        $response = Http::get("https://libur.deno.dev/api?year={$tahun}");

        foreach ($response->json() as $item) {

            HariLibur::updateOrCreate(
                ['tanggal' => $item['date']],
                [
                    'nama' => $item['name'],
                ]
            );
        }

        $this->info('✅ Sync hari libur selesai');
    }
}
