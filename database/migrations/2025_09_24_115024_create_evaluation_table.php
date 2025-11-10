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
        $table->date('data');
        $table->decimal('sumatori', 5, 2);
        $table->string('observacions')->nullable();
        $table->text('arxiu')->nullable();
        $table->unsignedBigInteger('id_profesional');
        $table->unsignedBigInteger('id_profesional_avaluador')->nullable();
        $table->foreign('id_profesional')->references('id')->on('profesional')->onDelete('cascade');
        $table->foreign('id_profesional_avaluador')->references('id')->on('profesional')->onDelete('cascade');
        
        for ($i = 0; $i < 20; $i++) {
            $table->decimal('q'.$i, 5, 2)->nullable();
        }

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
