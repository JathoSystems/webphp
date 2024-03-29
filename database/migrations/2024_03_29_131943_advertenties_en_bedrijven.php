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
        Schema::create('advertenties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->dateTime('expiration_date');
            $table->string('status');
            $table->string('QR_code');
            $table->timestamps();
        });

        Schema::create('bedrijven', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained();
            $table->string('logo_url');
            $table->json('color_scheme');
            $table->string('landing_page_url');
            $table->timestamps();
        });

        Schema::create('verhuur_advertenties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->dateTime('expiration_date');
            $table->string('status');
            $table->string('QR_code');
            $table->string('slijtage');
            $table->string('foto_upload');
            $table->timestamps();
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
