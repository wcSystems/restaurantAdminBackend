<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rest_menu_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->float('price');
            $table->float('discount')->nullable()->default(0);
            $table->bigInteger('sale_order_id')->unsigned();
            $table->timestamps();

            //Fk
            $table->foreign('rest_menu_id')->references('id')->on('rest_menus');
            $table->foreign('sale_order_id')->references('id')->on('sale_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_order_details');
    }
}
