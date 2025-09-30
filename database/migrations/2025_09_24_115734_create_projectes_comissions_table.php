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
        Schema::create('projectes_comissions', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->string('tipus', 255);
            $table->date('data_inici');
            $table->unsignedBigInteger('profesional_id');
            $table->foreign('profesional_id')->references('id')->on('profesional')->onDelete('cascade');
            $table->text('descripcio');
            $table->text('observacions');
            $table->unsignedBigInteger('centre_id');
            $table->foreign('centre_id')->references('id')->on('center')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projectes_comissions');
    }
};
