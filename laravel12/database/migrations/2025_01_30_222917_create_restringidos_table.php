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
        Schema::create('restringidos', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion')->unique();
            $table->string('name');
            $table->timestamp('date');
            $table->string('direction');
            $table->string('telephone');
            $table->string('email');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restringidos');
    }
};
