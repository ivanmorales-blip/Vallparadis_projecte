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
        Schema::create('professionals_projects', function (Blueprint $table) {
            $table->id();
            $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');
            $table->foreign('projecte_id')->references('id')->on('projectes_comissions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals_projects');
    }
};
