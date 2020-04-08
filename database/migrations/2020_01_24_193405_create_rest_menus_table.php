<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rest_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('category_menu_id')->unsigned();
            $table->bigInteger('meal_time_id')->unsigned();
            $table->integer('min_quantity')->default(1);
            $table->integer('stock_quantity')->default(1);
            $table->bigInteger('order_restriction_id')->unsigned();
            $table->string('description')->nullable();
            $table->float('price')->default(0);
            $table->boolean('restart_stock')->default(true);
            $table->string('image')->nullable();
            $table->float('production_minutes')->nullable();
            $table->float('cooking_minutes')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            //Fk
            $table->foreign('category_menu_id')->references('id')->on('category_menus');
            $table->foreign('meal_time_id')->references('id')->on('meal_times');
            $table->foreign('order_restriction_id')->references('id')->on('order_restrictions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rest_menus');
    }
}
