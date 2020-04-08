<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleOrderTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_order_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sale_order_id')->unsigned();
            $table->bigInteger('table_id')->unsigned();
            $table->string('station')->default('1');
            $table->timestamps();

            //Fk
            $table->foreign('sale_order_id')->references('id')->on('sale_orders');
            $table->foreign('table_id')->references('id')->on('tables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_order_table');
    }
}
