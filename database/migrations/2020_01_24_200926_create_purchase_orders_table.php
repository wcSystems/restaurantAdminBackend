<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('num_invoice')->nullable();
            $table->date('required_date')->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('arrival_date')->nullable();
            $table->boolean('status')->default(true);
            $table->bigInteger('provider_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            // FK
            $table->foreign('provider_id')->references('id')->on('providers');
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
        Schema::dropIfExists('purchase_orders');
    }
}
