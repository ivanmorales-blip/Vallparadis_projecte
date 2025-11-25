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
    Schema::table('seguiments', function (Blueprint $table) {
        $table->boolean('actiu')->default(true)->after('centre_id');
    });
}

public function down(): void
{
    Schema::table('seguiments', function (Blueprint $table) {
        $table->dropColumn('actiu');
    });
}

};
