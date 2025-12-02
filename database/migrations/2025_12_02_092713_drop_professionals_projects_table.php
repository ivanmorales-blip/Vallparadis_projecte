<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Esto eliminará la tabla si existe
        Schema::dropIfExists('professionals_projects');
    }

    public function down(): void
    {
        // Opcional: volver a crear la tabla si quieres revertir
        Schema::create('professionals_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professional_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();
        });
    }
};