<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product_details', function (Blueprint $table) {
            // $table->id();
            $table->integer('product_id');
            $table->integer('size_id');
            $table->integer('SL');
            $table->primary(['product_id', 'size_id']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('tbl_product_details');
    }
};
