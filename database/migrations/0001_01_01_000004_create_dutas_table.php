<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dutas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kelas');
            $table->string('title');
            $table->text('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dutas');
    }
};
