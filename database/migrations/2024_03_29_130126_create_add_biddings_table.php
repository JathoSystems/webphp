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
        Schema::create('ad_biddings', function (Blueprint $table) {
            $table->id();
            $table->double('price');
            $table->string('user');
            $table->dateTime('dateTime');
            $table->integer('adId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_biddings');
    }
};
