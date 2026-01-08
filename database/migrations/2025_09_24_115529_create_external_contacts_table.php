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
        Schema::create('external_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('centre_id');
            $table->foreign('centre_id')->references('id')->on('center')->onDelete('cascade');
            $table->string('tipus_servei', 255);
            $table->string('empresa_departament', 255);
            $table->string('responsable', 255);
            $table->string('telefon', 255);
            $table->string('correu', 255);
            $table->text('observacions');
            $table->boolean('actiu')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_contacts');
    }
};
