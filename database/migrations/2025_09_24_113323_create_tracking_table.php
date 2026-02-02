<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracking', function (Blueprint $table) {
            $table->id();
            $table->string('tipus');
            $table->date('data');
            $table->string('tema');
            $table->text('comentari');

            $table->unsignedBigInteger('id_profesional')->nullable();
            $table->unsignedBigInteger('id_profesional_registrador')->nullable();
            $table->unsignedBigInteger('id_general_services')->nullable();
            $table->unsignedBigInteger('id_manteniment')->nullable();
            $table->unsignedBigInteger('id_human_resource')->nullable();

            $table->boolean('estat')->default(true);
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_profesional')
                  ->references('id')->on('profesional')->nullOnDelete();
            $table->foreign('id_profesional_registrador')
                  ->references('id')->on('profesional')->nullOnDelete();
            $table->foreign('id_general_services')
                  ->references('id')->on('general_services')->cascadeOnDelete();
            $table->foreign('id_manteniment')
                  ->references('id')->on('maintenance')->nullOnDelete();
            $table->foreign('id_human_resource')
                  ->references('id')->on('temes_pendents')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking');
    }
};
