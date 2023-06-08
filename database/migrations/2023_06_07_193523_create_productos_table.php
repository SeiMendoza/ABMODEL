<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("descripcion");
            $table->double("precio");
            $table->string("tamanio");
            $table->string("imagen");
            $table->integer("disponible");
            $table->date("fecha")->nullable();
            $table->boolean('estado')->default(1);
            $table->tinyInteger('tipo'); // 1 para bebida, 2 para platillo y 0 para complemeto
            $table->boolean('esComplemento')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
