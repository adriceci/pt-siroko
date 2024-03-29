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
        Schema::create('carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->uuid('cart_uuid')->unique();
            $table->unsignedBigInteger('user_id');
            $table->json('products');
            $table->decimal('amount', 12, 2);
            $table->boolean('ordered')->default(false);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
