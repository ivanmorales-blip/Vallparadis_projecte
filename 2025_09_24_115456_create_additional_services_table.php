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
        Schema::create('additional_services', function (Blueprint $table) {
            $table->id();
            $table->foreign('centre_id')->references('id')->on('centre')->onDelete('cascade');
            $table->string('tipus', 255);
            $table->date('data_inici');
            $table->string('responsable', 255);
            $table->string('contacte', 255);
            $table->text('observacions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_services');
    }
};
