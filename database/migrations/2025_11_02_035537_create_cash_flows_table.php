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
        Schema::create('cash_flows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->nullable()->constrained('transactions')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained('service_hps')->onDelete('cascade');
            $table->foreignId('oprasional_id')->nullable()->constrained('oprasionals')->onDelete('cascade');
            $table->enum('type_trans', ['in', 'out']);
            $table->enum('category', ['purchase', 'selling', 'service', 'oprasional']);
            $table->decimal('amount', 15, 2);
            $table->decimal('profit', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_flows');
    }
};
