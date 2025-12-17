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
        Schema::create('tracking', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Necesario para claves foráneas
            $table->id();
            $table->string('tipus', 255);
            $table->date('data');
            $table->string('tema', 255);
            $table->text('comentari');
            $table->unsignedBigInteger('id_profesional');
            $table->unsignedBigInteger('id_profesional_registrador');
            $table->unsignedBigInteger('id_general_services');
            $table->unsignedBigInteger('id_manteniment');
            $table->boolean('estat')->default(true);
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_profesional')
                  ->references('id')
                  ->on('profesional')
                  ->onDelete('cascade');

            $table->foreign('id_profesional_registrador')
                  ->references('id')
                  ->on('profesional')
                  ->onDelete('cascade');

            $table->foreign('id_general_services')
                  ->references('id')
                  ->on('general_services')
                  ->onDelete('cascade');

            $table->foreign('id_manteniment')
                  ->references('id')
                  ->on('maintenance')
                  ->onDelete('cascade');
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
