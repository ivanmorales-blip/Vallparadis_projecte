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
        Schema::create('evaluation', function (Blueprint $table) {
            $table->id();
            $table-> date('data', 255);
            $table-> integer('sumatori');
            $table-> string('observacions', 255);
            $table-> text('arxiu', 255);
            $table->foreign('id_profesional')->references('id')->on('profesionals')->onDelete('cascade');
            $table->foreign('id_profesional_avaluador')->references('id')->on('profesionals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation');
    }
};
