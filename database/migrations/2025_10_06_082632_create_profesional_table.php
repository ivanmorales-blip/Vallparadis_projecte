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
            $table-> string('nom', 255);
            $table-> string('cognom', 255);
            $table->integer('telefon');
            $table-> string('correu', 255);
            $table-> string('adreça', 255);
            $table-> string('estat', 255);
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
