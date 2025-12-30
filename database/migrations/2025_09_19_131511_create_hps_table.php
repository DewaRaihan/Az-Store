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
        Schema::create('hps', function (Blueprint $table) {
            $table->id();
            $table->string("code_hp")->unique()->nullable();
            $table->dateTime('date');
            $table->string("type_hp")->nullable();
            $table->string('grade')->nullable();
            $table->enum('status', ['available', 'sold']);
            $table->enum('status_in_catalog', ['active', 'draft', 'non active'])->default('draft');
            $table->decimal('price_in_catalog', 15, 2)->default(0.00);
            $table->string("notes")->default("tidak ada catatan");
            $table->foreignId('detail_id')->nullable()->constrained('details')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hps');
    }
};
