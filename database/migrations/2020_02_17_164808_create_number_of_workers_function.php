<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNumberOfWorkersFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE FUNCTION `number_of_workers`() RETURNS int(11)
            BEGIN
                DECLARE nw INTEGER;
                SELECT count(*) INTO nw FROM employees;
            RETURN nw;
            END"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS number_of_workers;');
    }
}
