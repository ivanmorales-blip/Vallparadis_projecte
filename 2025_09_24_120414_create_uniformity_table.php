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
        Schema::create('uniformity', function (Blueprint $table) {
            $table->id();
            $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');
            $table->string('talla_samarreta');
            $table->string('talla_pantalons');
            $table->string('talla_sabates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uniformity');
    }
};
