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
        Schema::create('tracking', function (Blueprint $table) {
            $table->id();
            $table-> string('tipus', 255);
            $table-> date('data', 255);
            $table-> string('tema', 255);
            $table-> text('comentari', 255);
            $table->unsignedBigInteger('id_profesional');
            $table->unsignedBigInteger('id_profesional_registrador');
            $table->foreign('id_profesional')->references('id')->on('profesional')->onDelete('cascade');
            $table->foreign('id_profesional_registrador')->references('id')->on('profesional')->onDelete('cascade');
            $table->boolean('estat')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking');
    }
};
