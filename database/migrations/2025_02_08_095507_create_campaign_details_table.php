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
        Schema::create('campaign_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');  // Foreign key referencing orders table
            $table->string('ad_title');
            $table->string('campaign_description');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('terms_and_conditions')->nullable();
            $table->boolean('privacy_policy')->nullable();
            $table->string('art_work')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_details');
    }
};
