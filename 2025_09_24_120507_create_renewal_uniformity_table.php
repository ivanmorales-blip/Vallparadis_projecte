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
        Schema::create('renewal_uniformity', function (Blueprint $table) {
            $table->id();
            $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');
            $table->datetime('data_renovacio');
            $table->string('material_entregat', 255);
            $table->foreign('professional_entregat_id')->references('id')->on('professional')->onDelete('cascade');
            $table->text('Arxiu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renewal_uniformity');
    }
};
