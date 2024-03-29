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
        // add the image upload and slijtage columns to the Advertentie model
        Schema::table('advertenties', function (Blueprint $table) {
            $table->string('type')->default('advertentie');
            $table->string('image_upload')->nullable();
            $table->string('slijtage')->nullable();
        });

        // drop the verhuur_advertenties table
        Schema::dropIfExists('verhuur_advertenties');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
