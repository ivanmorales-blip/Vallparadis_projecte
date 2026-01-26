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
        Schema::create('accidentability', function (Blueprint $table) {
            $table->id();
            $table-> date('data', 255);
            $table-> string('tipus', 255);
            $table-> text('descripcio', 255);
            $table-> text('context', 255);
            $table->string('durada', 255)->nullable();
            $table->unsignedBigInteger('id_profesional');
            $table->foreign('id_profesional')->references('id')->on('profesional')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidentability');
    }
};
