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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('signage_id');
            $table->decimal('price_per_day', 10, 2);
            $table->integer('rotation_time')->nullable();
            $table->integer('avg_daily_views')->nullable();
            $table->decimal('total', 10, 2);  // The total cost of the signage
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('signage_id')->references('id')->on('signages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
