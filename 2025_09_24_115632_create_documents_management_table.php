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
        Schema::create('documents_management', function (Blueprint $table) {
            $table->id();
            $table->foreign('centre_id')->references('id')->on('centre')->onDelete('cascade');
            $table->string('tipus', 255);
            $table->datetime('data');
            $table->text('descripcio');
            $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');
            $table->text('arxiu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_management');
    }
};
