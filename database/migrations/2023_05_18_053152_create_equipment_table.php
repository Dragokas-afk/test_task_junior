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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->double('price', 8, 2);
            $table->string('series_number', 13)->unique();
            $table->string('inventory_number', 8)->unique();
            $table->date('created_at')->nullable();
            $table->date('move_date')->nullable();
            $table->foreignId('stock_id')->nullable()->references('id')->on('stocks');
            $table->string('status')->default('Новое');
            $table->integer('provider_id');
            $table->integer('manager_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
