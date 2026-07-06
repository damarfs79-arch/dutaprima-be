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
        Schema::table('dutas', function (Blueprint $table) {
            $table->text('visi_female')->nullable()->after('misi');
            $table->text('misi_female')->nullable()->after('visi_female');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dutas', function (Blueprint $table) {
            $table->dropColumn(['visi_female', 'misi_female']);
        });
    }
};
