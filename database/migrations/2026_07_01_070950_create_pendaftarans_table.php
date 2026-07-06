<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_kelas_jurusan');
            $table->string('ttl');
            $table->string('bakat');
            $table->text('prestasi')->nullable();
            $table->string('file_prestasi')->nullable();
            $table->text('motivasi')->nullable();
            $table->string('foto_full');
            $table->string('foto_half');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
