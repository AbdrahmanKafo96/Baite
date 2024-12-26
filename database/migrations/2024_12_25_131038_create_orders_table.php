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
            $table->enum("status", [
                "pending",
                "confirmed",
                'canceled',
                'shipping',
                'delivered',
            ]);
            $table->string('phone_number');
            $table->json('quantity');
            $table->enum("status", [
                "accepted",
                'canceled',
            ]);
            // $table->string('payment_method');
            $table->float('total_price');
            $table->float('cost');
            // $table->json('cart_id')->references('id')->on('carts');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->json('product_codes'); //->references('product_code')->on('products');
            $table->date('created_at')->nullable();
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
