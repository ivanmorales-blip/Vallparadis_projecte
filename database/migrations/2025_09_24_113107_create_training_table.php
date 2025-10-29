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
        Schema::create('training', function (Blueprint $table) {
            $table->id();
            $table-> string('nom_curs', 255);
            $table-> date('data_inici', 255);
            $table-> date('data_fi', 255);
            $table-> string('hores', 255);
            $table-> text('objectiu', 255);
            $table-> text('descripcio', 255);
            $table-> string('formador', 255);
            $table->unsignedBigInteger('id_center')->nullable();
            $table->foreign('id_center')->references('id')->on('center')->onDelete('set null');
            $table->boolean('estat')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training');
    }
};
