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
        Schema::create('projectes_comissions_profesional', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_profesional');
            $table->unsignedBigInteger('id_projecte_comissio');
            $table->foreign('id_profesional')->references('id')->on('profesional')->onDelete('cascade');
            $table->foreign('id_projecte_comissio')->references('id')->on('projectes_comissions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projectes_comissions_profesional');
    }
};
