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
        Schema::create('oprasionals', function (Blueprint $table) {
            $table->id();
            $table->string('oprasional_code')->unique()->nullable();
            $table->string('name')->nullable();
            $table->decimal('cost', 15, 2)->default(0.00);
            $table->integer('qty')->nullable();
            $table->string('notes')->default('tidak ada catatan');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oprasionals');
    }
};
