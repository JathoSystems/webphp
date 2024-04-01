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
        Schema::table('advertenties', function (Blueprint $table) {
            $table->integer('slijtage_percentage')->default(0);
            $table->integer('slijtage')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertenties', function (Blueprint $table) {
            $table->dropColumn('slijtage_percentage');
        });
    }
};
