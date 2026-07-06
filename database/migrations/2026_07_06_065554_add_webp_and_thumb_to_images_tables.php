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
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('image_webp')->nullable()->after('image');
            $table->string('image_thumb')->nullable()->after('image_webp');
        });

        Schema::table('dutas', function (Blueprint $table) {
            $table->string('photo_webp')->nullable()->after('photo');
            $table->string('photo_thumb')->nullable()->after('photo_webp');
            $table->string('photo_female_webp')->nullable()->after('photo_female');
            $table->string('photo_female_thumb')->nullable()->after('photo_female_webp');
            $table->string('photo_couple_webp')->nullable()->after('photo_couple');
            $table->string('photo_couple_thumb')->nullable()->after('photo_couple_webp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dutas', function (Blueprint $table) {
            $table->dropColumn([
                'photo_webp', 'photo_thumb',
                'photo_female_webp', 'photo_female_thumb',
                'photo_couple_webp', 'photo_couple_thumb'
            ]);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['image_webp', 'image_thumb']);
        });
    }
};
