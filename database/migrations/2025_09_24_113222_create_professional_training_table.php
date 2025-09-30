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
        Schema::create('professional_training', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_training');
            $table->unsignedBigInteger('id_profesional');
            $table->foreign('id_profesional')->references('id')->on('profesional')->onDelete('cascade');
            $table->foreign('id_training')->references('id')->on('training')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_training');
    }
};
