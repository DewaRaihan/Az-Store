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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string("transaction_code")->unique()->nullable();
            $table->dateTime('date');
            $table->enum('type_trans', ['purchase', 'selling', 'trade']);
            $table->foreignId("hp_in")->nullable()->constrained('hps')->onDelete('cascade');
            $table->foreignId("hp_out")->nullable()->constrained('hps')->onDelete('cascade');
            $table->foreignId("related_transaction_id")->nullable()->constrained('transactions')->onDelete('cascade');
            $table->decimal("extra_fee", 15, 2)->default(0.00);
            $table->decimal("purchase_price", 15, 2)->default(0.00);
            $table->decimal("selling_price", 15, 2)->default(0.00);
            $table->decimal("profit", 15, 2)->default(0.00);
            $table->string("notes")->default("tidak ada catatan");
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
