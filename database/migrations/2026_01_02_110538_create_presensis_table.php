<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('konfigurasi_id')->constrained('konfigurasi')->onDelete('cascade');
            $table->foreignId('pengajuan_id')->nullable()->constrained()->nullOnDelete();
            $table->date('tanggal');
            $table->enum('status', ['pending', 'hadir', 'sakit', 'izin', 'alpha'])->default('hadir');
            $table->boolean('is_late')->default(false);
            $table->unsignedSmallInteger('late_minutes')->nullable();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->decimal('lat_masuk', 11, 8)->nullable();
            $table->decimal('lng_masuk', 11, 8)->nullable();
            $table->decimal('lat_keluar', 11, 8)->nullable();
            $table->decimal('lng_keluar', 11, 8)->nullable();
            $table->boolean('locked')->default(false);
            $table->timestamps();
            $table->string('keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
