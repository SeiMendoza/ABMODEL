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
        Schema::create('platillosy_bebidas', function (Blueprint $table) {
            $table->id();
            $table->boolean("tipo")->default(0);

            $table->string("nombre");
            $table->string("descripcion");
            $table->double("precio");
            $table->string("tamanio");
            $table->string("imagen");

            $table->integer("cantidad")->nullable();

            $table->integer("disponible")->nullable();

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
        Schema::dropIfExists('platillosy_bebidas');
    }
};
