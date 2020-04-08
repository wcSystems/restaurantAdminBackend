<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('img_profile')->nullable();
            $table->string('password');
            $table->bigInteger("master")->nullable()->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->string('api_token',60)->unique();
            $table->timestamps();
            $table->softDeletes();
            //FK
            $table->foreign('master')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
