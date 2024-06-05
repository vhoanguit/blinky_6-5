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
        Schema::create('tbl_data_per_day', function (Blueprint $table) {
            $table->integer('data_id', 10)->autoIncrement();
            $table->date('date');
            $table->integer('order_count');
            $table->decimal('total_revenue', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_data_per_day');
    }
};
