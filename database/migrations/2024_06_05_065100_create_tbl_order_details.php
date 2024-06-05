<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
Schema::create('tbl_order_details', function (Blueprint $table) {
$table->bigInteger('order_id')->unsigned(); // bigint(20), unsigned for foreign key
$table->integer('product_id')->unsigned(); // int(10), unsigned for foreign key
$table->integer('size_id')->unsigned(); // int(10), unsigned for foreign key
$table->integer('product_quantity'); // int(11)
$table->decimal('product_price', 10, 2); // decimal(10,2)
$table->decimal('total_price', 10, 2); // decimal(10,2)
// Composite primary key
$table->primary(['order_id', 'product_id', 'size_id']);
// Foreign keys
$table->foreign('order_id')->references('order_id')->on('tbl_customer_order')->onDelete('cascade');
$table->foreign('product_id')->references('product_id')->on('tbl_product')->onDelete('cascade');
$table->foreign('size_id')->references('size_id')->on('tbl_size')->onDelete('cascade');
});
}

/**
* Reverse the migrations.
*
* @return void
*/
public function down()
{
Schema::dropIfExists('tbl_order_details');
}
};
