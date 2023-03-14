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
        Schema::create('reservacion_totals', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre_Cliente");
            $table->string("Apellido_Cliente");
            $table->date("Fecha");
            $table->time("Hora");
            $table->string("Contacto");
            $table->string("Tipo_Evento");
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
        Schema::dropIfExists('reservacion_totals');
    }
};
