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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_name');
            $table->string('note');
            $table->enum("status", [
                "pending",
                "confirmed",
                'canceled',
                'shipping',
                'delivered',
            ]);
            $table->string('phone_number');
            $table->json('quantity');
            $table->float('total_price');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('service_id')->references('id')->on('my_service_level_tows');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
