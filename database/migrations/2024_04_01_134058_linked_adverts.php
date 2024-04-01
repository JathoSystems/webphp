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
        Schema::create('related_advertenties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertentie_id')->constrained('advertenties')->onDelete('cascade');
            $table->foreignId('related_advertentie_id')->constrained('advertenties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_advertenties');
    }
};
