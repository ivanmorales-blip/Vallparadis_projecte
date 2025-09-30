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
            $table-> string('nom', 255);
            $table-> string('cognom', 255);
            $table-> string('telefon', 255);
            $table-> string('email', 255);
            $table-> string('estat_vinculacio', 255);
            $table->unsignedBigInteger('id_center');
            $table->foreign('id_center')->references('id')->on('center')->onDelete('cascade');
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
