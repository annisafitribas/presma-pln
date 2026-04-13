<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->text('keterangan')->nullable();
            $table->enum('jenis', ['izin', 'sakit']);

            $table->string('bukti'); // path file pdf
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
