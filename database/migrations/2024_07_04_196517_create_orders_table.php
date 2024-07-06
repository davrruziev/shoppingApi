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
            $table->foreignId('user_id')->constrained();
            $table->text('comment')->nullable();
            $table->foreignId('delivery_method_id')->constrained();
            $table->foreignId('payment_type_id')->constrained();
            $table->foreignId('status_id')->default(1)->constrained();
            $table->unsignedBigInteger('sum');
            $table->text('address')->nullable();
            $table->json('products');
            $table->timestamps();
            $table->softDeletes();
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
