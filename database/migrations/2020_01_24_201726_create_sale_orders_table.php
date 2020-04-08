<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num_invoice')->nullable()->unique();
            $table->date('date');
            $table->date('required_date')->nullable();
            $table->date('shipped_date')->nullable();
            $table->bigInteger('status_order_id')->unsigned()->default(1);
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('order_type_id')->unsigned()->default(1);
            $table->bigInteger('user_id')->unsigned();
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->foreign('status_order_id')->references('id')->on('status_orders');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('order_type_id')->references('id')->on('order_types');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_orders');
    }
}
