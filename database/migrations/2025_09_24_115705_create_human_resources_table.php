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
        Schema::create('human_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('centre_id');
            $table->unsignedBigInteger('professional_id');
            $table->foreign('professional_id')->references('id')->on('profesional')->onDelete('cascade');
            $table->foreign('centre_id')->references('id')->on('center')->onDelete('cascade');
            $table->date('data_opertura');
            $table->text('descripcio');
            $table->string('estat', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('human_resources');
    }
};
