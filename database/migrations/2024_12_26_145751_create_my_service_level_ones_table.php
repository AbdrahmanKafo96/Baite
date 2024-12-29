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
        Schema::create('my_service_level_ones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->references('id')->on('my_services');
            $table->string('service_name');
            $table->string('description');
            $table->boolean('show');
            $table->string('icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_service_level_ones');
    }
};
