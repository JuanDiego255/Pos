<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGetBfStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP FUNCTION IF EXISTS get_bf(BIGINT);");
        DB::unprepared(
            'CREATE FUNCTION get_bf(idfactura BIGINT)
        RETURNS TABLE(id BIGINT, column1 TYPE, column2 TYPE, ...) AS $$
        BEGIN
            RETURN QUERY 
            SELECT * FROM billings 
            WHERE id = idfactura;
        END;
        $$ LANGUAGE plpgsql;'
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('get_bf_stored_procedures');
    }
}
