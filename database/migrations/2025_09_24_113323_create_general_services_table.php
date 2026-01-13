<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('general_services', function (Blueprint $table) {
            $table->id();
            $table->string('tipus');
            $table->string('contacte');
            $table->string('encarregat');
            $table->string('horari');
            $table->text('observacions')->nullable();
            $table->unsignedBigInteger('id_center');
            $table->timestamps();

            $table->foreign('id_center')->references('id')->on('center')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('general_services');
    }
};
