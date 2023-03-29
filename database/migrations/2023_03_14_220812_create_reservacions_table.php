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
            $table->string('nombre');
            $table->string('celular');
            $table->date('fecha');
            $table->time('hora');
            $table->string('tipo');
            $table->double('alimentos');
            $table->integer('cantidad');
            $table->float('precio');
            $table->float('total');
            $table->float('anticipo');
            $table->float('pendiente');
            $table->string('formaPago');
            $table->double('estado');
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
