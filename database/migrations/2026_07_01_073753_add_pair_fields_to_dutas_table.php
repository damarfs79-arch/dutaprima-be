<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dutas', function (Blueprint $table) {
            $table->string('name_female')->nullable()->after('name'); // Nama pasangan perempuan
            $table->string('photo_female')->nullable()->after('photo'); // Foto pasangan perempuan
            $table->text('visi')->nullable()->after('photo_female');
            $table->text('misi')->nullable()->after('visi');
        });
    }

    public function down(): void
    {
        Schema::table('dutas', function (Blueprint $table) {
            $table->dropColumn(['name_female', 'photo_female', 'visi', 'misi']);
        });
    }
};
