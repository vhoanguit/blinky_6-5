<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable('tbl_favorite')) {
            Schema::create('tbl_favorite', function (Blueprint $table) {
                $table->integer('customer_id');
                $table->integer('product_id');
                $table->timestamps();
                $table->primary(['customer_id','product_id']);  
            });
        }
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_favorite');
    }
};