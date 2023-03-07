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
        Schema::create('detalles_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            //$table->foreign('pedido_id')->references('id')->on('pedidos')->onDelate('cascade');
            $table->unsignedBigInteger('platillo_id');
           // $table->foreign('platillo_id')->references('id')->on('platillos')->onDelate('cascade');
            $table->string('cantidad');
            $table->string('precio',);
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
        Schema::dropIfExists('detalles_usuarios');
    }
};
