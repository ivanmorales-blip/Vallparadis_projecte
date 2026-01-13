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
        // Asegúrate que estas tablas ya existan antes de migrar tracking:
        // general_services, maintenance, human_resources, profesional

        Schema::create('tracking', function (Blueprint $table) {
            $table->id();

            $table->string('tipus', 255);
            $table->date('data');
            $table->string('tema', 255);
            $table->text('comentari');

            // Relaciones opcionales
            $table->unsignedBigInteger('id_profesional')->nullable();
            $table->unsignedBigInteger('id_profesional_registrador')->nullable();
            $table->unsignedBigInteger('id_general_services')->nullable();
            $table->unsignedBigInteger('id_manteniment')->nullable();
            $table->unsignedBigInteger('id_human_resource')->nullable();

            $table->boolean('estat')->default(true);
            $table->timestamps();

            // Claves foráneas
            $table->foreign('id_general_services')
                  ->references('id')->on('general_services')
                  ->onDelete('cascade');

            $table->foreign('id_profesional')
                  ->references('id')->on('profesional')
                  ->nullOnDelete();

            $table->foreign('id_profesional_registrador')
                  ->references('id')->on('profesional')
                  ->nullOnDelete();

            $table->foreign('id_manteniment')
                  ->references('id')->on('maintenance')
                  ->nullOnDelete();

            $table->foreign('id_human_resource')
                  ->references('id')->on('human_resources')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking');
    }
};
