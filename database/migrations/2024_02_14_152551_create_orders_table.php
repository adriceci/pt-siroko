<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->uuid('order_uuid');
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('cart_id')->references('cart_id')->on('carts');
            $table->foreign('status_id')->references('status_id')->on('order_statuses');
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
