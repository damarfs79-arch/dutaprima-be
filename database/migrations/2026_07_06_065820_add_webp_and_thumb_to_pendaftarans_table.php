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
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('foto_full_webp')->nullable()->after('foto_full');
            $table->string('foto_full_thumb')->nullable()->after('foto_full_webp');
            $table->string('foto_half_webp')->nullable()->after('foto_half');
            $table->string('foto_half_thumb')->nullable()->after('foto_half_webp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn([
                'foto_full_webp', 'foto_full_thumb',
                'foto_half_webp', 'foto_half_thumb'
            ]);
        });
    }
};
