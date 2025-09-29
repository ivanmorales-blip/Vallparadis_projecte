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
        Schema::create('general_services', function (Blueprint $table) {
            $table->id();
            $table-> string('tipus', 255);
            $table-> string('contacte', 255);
            $table-> string('encarregat', 255);
            $table->foreign('id_centre')->references('id')->on('center')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_services');
    }
};
