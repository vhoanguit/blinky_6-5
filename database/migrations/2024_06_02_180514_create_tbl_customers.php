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
        Schema::create('tbl_customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->string('customer_email', 100)->unique();
            $table->string('customer_password');
            $table->date('customer_date')->nullable();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_city')->nullable();
            $table->string('customer_district')->nullable();
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
        Schema::dropIfExists('tbl_customers');
    }
};
