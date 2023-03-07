<<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(" CREATE VIEW productosfinales AS
        SELECT *, ROW_NUMBER() OVER(ORDER BY nombre) id
        FROM (
        	SELECT imagen,nombre, precio, tipo, estado, id_platillo, id_bebidas, null as id_combo FROM platillosbebidas
            UNION 
            SELECT imagen,nombre, precio, NULL,estado, NULL, NULL, id AS id_combo FROM combos
       )a
       
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS productosfinales;");
    }
}