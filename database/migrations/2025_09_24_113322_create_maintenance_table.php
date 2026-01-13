<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_obertura');
            $table->text('descripcio');
            $table->unsignedBigInteger('centre_id');
            $table->text('documentacio');
            $table->text('responsable');
            $table->boolean('estat')->default(true);
            $table->timestamps();

            $table->foreign('centre_id')->references('id')->on('center')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
