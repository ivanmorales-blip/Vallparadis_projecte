<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seguiments', function (Blueprint $table) {
            $table->id();

            $table->date('data');
            $table->string('professional');
            $table->text('descripcio');
            $table->string('document')->nullable();
            $table->unsignedBigInteger('centre_id');
            $table->foreign('centre_id')->references('id')->on('center')->onDelete('cascade');

            $table->boolean('actiu')->default(true); // <-- añadido

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguiments');
    }
};
