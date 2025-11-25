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
        $table->string('professional_afectat');
        $table->text('descripcio');
        $table->string('professional_registra')->nullable();
        $table->string('derivat_a')->nullable();
        $table->string('document')->nullable();

        // Relación con centro
        $table->unsignedBigInteger('centre_id');
        $table->foreign('centre_id')->references('id')->on('center')->onDelete('cascade');

        $table->boolean('actiu')->default(true); 

        $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('temes_pendents');
    }
};
