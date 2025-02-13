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
        Schema::create('signages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('category_name');
            $table->string('slug');
            $table->longText('description');
            $table->integer('avg_daily_views');
            $table->float('per_day_price');
            $table->string('display_size');
            $table->string('exposure_time');
            $table->integer('on_going_ad');
            $table->integer('space_left_for_ad');
            $table->string('location');
            $table->string('lat');
            $table->string('lan');
            $table->string('image')->nullable();
            $table->enum('terms_and_conditions', ['on', 'off'])->default('on');
            $table->enum('privacy_policy', ['on', 'off'])->default('on');
            $table->enum('status', ['active', 'inactive','rejected'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signages');
    }
};
