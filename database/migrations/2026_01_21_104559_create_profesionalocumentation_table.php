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
        Schema::create('profesionalocumentation', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table-> string('nom', 255);
            $table->text('fitxer');
            $table->dateTime('data');
            $table->unsignedBigInteger('id_profesional');

            $table->foreign('id_profesional')->references('id')->on('profesional')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionalocumentation');
    }
};
