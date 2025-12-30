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
        Schema::create('monthly_summaries', function (Blueprint $table) {
            $table->id();
            $table->string("year");
            $table->string("month");
            $table->decimal('total_purchase', 15, 2);
            $table->decimal('total_selling', 15, 2);
            $table->decimal('total_service', 15, 2);
            $table->decimal('total_oprasional', 15, 2);
            $table->decimal('total_profit', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_summaries');
    }
};
