<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temes_pendents', function (Blueprint $table) {
            $table->id();
            $table->date('data_obertura');
            $table->string('tema_pendent');

            $table->unsignedBigInteger('professional_afectat')->nullable();
            $table->unsignedBigInteger('professional_registra')->nullable();
            $table->unsignedBigInteger('derivat_a')->nullable();

            $table->text('descripcio');
            $table->string('document')->nullable();
            $table->unsignedBigInteger('centre_id');
            $table->boolean('actiu')->default(true);
            $table->timestamps();

            // Foreign keys
            $table->foreign('professional_afectat')
                  ->references('id')->on('profesional')->nullOnDelete();
            $table->foreign('professional_registra')
                  ->references('id')->on('users')->nullOnDelete();
            $table->foreign('derivat_a')
                  ->references('id')->on('profesional')->nullOnDelete();
            $table->foreign('centre_id')
                  ->references('id')->on('center')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temes_pendents');
    }
};
