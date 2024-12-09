<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGetListOrdersStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS get_list_orders;");
        DB::unprepared(
            'CREATE PROCEDURE get_list_orders()
        BEGIN
            SELECT 
                orders.*, 
                users.user AS mesero, 
                IFNULL(tables.descripcion, "N/A") AS mesa
            FROM orders
            INNER JOIN users ON orders.idusuario = users.id
            LEFT JOIN tables ON orders.idmesa = tables.id
            ORDER BY orders.updated_at DESC;
        END;'
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('get_list_orders_stored_procedures');
    }
}
