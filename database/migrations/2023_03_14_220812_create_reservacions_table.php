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
        Schema::create('reservacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombreCliente', 50);
            $table->string('celular', 9);
            $table->date('fecha');
            $table->time('horaI');
            $table->time('horaF');
            $table->unsignedBigInteger('kiosko_id');
            $table->foreign('kiosko_id')->references('id')->on('kioskos')->onUpdate('cascade')->onDelate('cascade');
            $table->string('tipo', 50);
            $table->integer('cantidadAdultos');
            $table->integer('precioAdultos');
            $table->boolean('niños')->default(0);
            $table->integer('cantidadNinios')->default(0);
            $table->integer('PrecioNinios')->default(0);
            $table->float('total');
            $table->float('anticipo');
            $table->float('pendiente');
            $table->boolean('formaPago')->default(0);
            $table->boolean('estado')->default(0);
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
        Schema::dropIfExists('reservacions');
    }
};
