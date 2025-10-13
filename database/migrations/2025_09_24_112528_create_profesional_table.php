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
        Schema::create('profesional', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_center');
            $table->foreign('id_center')->references('id')->on('center')->onDelete('cascade');
            $table->string('nom', 255);
            $table->string('cognom', 255);
            $table->integer('telefon');
            $table->string('email', 255);
            $table->string('taquilla', 255);
            $table->string('adreça', 255);
            $table->string('talla_samarreta', 255);
            $table->string('talla_pantalons', 255);
            $table->string('talla_sabates', 255);
            $table->datetime('data_renovacio');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesional');
    }
};
