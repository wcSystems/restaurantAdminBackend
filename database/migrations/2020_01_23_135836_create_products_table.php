<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('category_product_id')->unsigned();
            $table->string('description')->nullable();
            $table->bigInteger('measure_unit_id')->unsigned();
            $table->float('conversion_factor')->nullable()->default(0);
            $table->integer('depletion_factor')->nullable()->default(0);
            $table->float('purchase_value')->nullable()->default(0);
            $table->float('stock_quantity')->nullable()->default(0);
            $table->float('min_quantity')->nullable()->default(0);
            $table->float('max_quantity')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_product_id')->references('id')->on('category_products');
            $table->foreign('measure_unit_id')->references('id')->on('measure_units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
