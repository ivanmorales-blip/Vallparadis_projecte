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
        Schema::create('personal_general_services', function (Blueprint $table) {
            $table->id();
            $table-> text('horari');
            $table-> string('observacions', 255);
            $table->unsignedBigInteger('id_profesional');
            $table->unsignedBigInteger('id_general_services');
            $table->foreign('id_profesional')->references('id')->on('profesional')->onDelete('cascade');
            $table->foreign('id_general_services')->references('id')->on('general_services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_general_services');
    }
};
