<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('temes_pendents', function (Blueprint $table) {
            $table->dropColumn('derivat_a');
        });

        Schema::table('temes_pendents', function (Blueprint $table) {
            $table->unsignedBigInteger('derivat_a')->nullable();
            $table->foreign('derivat_a')->references('id')->on('professionals')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('temes_pendents', function (Blueprint $table) {
            $table->dropForeign(['derivat_a']);
            $table->dropColumn('derivat_a');
            $table->string('derivat_a')->nullable();
        });
    }
};

