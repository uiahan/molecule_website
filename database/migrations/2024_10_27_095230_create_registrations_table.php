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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->string('domisili_perusahaan')->nullable();
            $table->string('peserta')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('akan_hadir')->nullable();
            $table->enum('telah_scan', ['Belum Scan', 'Sudah Scan'])->nullable();
            $table->string('kode')->nullable();
            $table->string('qr')->nullable();
            $table->json('unique_fields')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
