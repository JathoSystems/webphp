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
        // add the image url to both the Advertentie and VerhuurAdvertentie models
        Schema::table('advertenties', function (Blueprint $table) {
            $table->string('image_url');
        });

        Schema::table('verhuur_advertenties', function (Blueprint $table) {
            $table->string('image_url');
        });

        // change the image_upload column to nullable
        Schema::table('verhuur_advertenties', function (Blueprint $table) {
            $table->string('foto_upload')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
