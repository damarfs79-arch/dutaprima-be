<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peserta_seleksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kelas');
            $table->enum('status', ['lolos', 'tidak_lolos'])->default('lolos');
            $table->string('keterangan')->nullable(); // cth: "Lolos Tahap Selanjutnya"
            $table->timestamps();
        });

        Schema::create('kandidat_votings', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori'); // cth: "Calon Duta Favorit"
            $table->enum('popularitas', ['Tinggi', 'Sedang', 'Meningkat', 'Stabil'])->default('Sedang');
            $table->unsignedInteger('suara')->default(0);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kandidat_votings');
        Schema::dropIfExists('peserta_seleksis');
    }
};
