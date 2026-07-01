<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenis_surat');
            $table->string('nama');
            $table->string('nik');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('email');
            $table->text('keterangan')->nullable();
            $table->json('berkas');
            $table->string('status')->default('Menunggu Verifikasi');
            $table->text('catatan_admin')->nullable();
            $table->string('file_hasil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
