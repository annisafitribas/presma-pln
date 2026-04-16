<?php

namespace Database\Seeders;

use App\Models\User;
use App\Model\Office;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Jalankan seeder lainnya
        $this->call([
            // bidangseeder::class,
            UserSeeder::class,
            // konfigurasieeder::class,
        ]);
    }
}
