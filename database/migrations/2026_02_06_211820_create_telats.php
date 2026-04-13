<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('telats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('konfigurasi_id')->constrained('konfigurasi')->cascadeOnDelete();

            $table->date('tanggal');

            // Relasi ke presensi (diisi setelah approved)
            $table->foreignId('presensi_id')->nullable()->constrained('presensis')->nullOnDelete();

            // jam masuk real (yang user input / terekam)
            $table->time('jam_masuk');

            // koordinat masuk (untuk validasi titik kantor)
            $table->decimal('lat_masuk', 10, 7)->nullable();
            $table->decimal('lng_masuk', 10, 7)->nullable();

            // alasan kenapa telat
            $table->text('alasan')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->text('catatan_admin')->nullable();

            // admin yang approve
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();

            // Biar tidak spam pengajuan telat di hari yang sama
            $table->unique(['user_id', 'konfigurasi_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telats');
    }
};
