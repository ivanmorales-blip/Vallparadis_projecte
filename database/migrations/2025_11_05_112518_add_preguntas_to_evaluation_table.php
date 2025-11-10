<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('evaluation', function (Blueprint $table) {
            for ($i = 1; $i <= 20; $i++) {
                $column = 'pregunta' . $i;
                if (!Schema::hasColumn('evaluation', $column)) {
                    $table->integer($column)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('evaluation', function (Blueprint $table) {
            for ($i = 1; $i <= 20; $i++) {
                $column = 'pregunta' . $i;
                if (Schema::hasColumn('evaluation', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

