<<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewPlatillosBebidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(" CREATE VIEW platillosbebidas AS
        SELECT *, ROW_NUMBER() OVER(ORDER BY nombre) id
        FROM (
        	SELECT nombre,descripcion,'platillos' AS tipo, precio, id AS id_platillo, NULL AS id_bebidas,
			tamanio, imagen, disponible, fecha, created_at, updated_at, estado
			FROM platillos
			UNION 
			SELECT nombre,descripcion, 'bebidas' AS tipo, precio, NULL AS id_platillo, id AS id_bebidas,
			tamanio, imagen, disponible, fecha, created_at, updated_at, estado
			FROM bebidas
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
        DB::statement("DROP VIEW IF EXISTS platillosbebidas;");
    }
}