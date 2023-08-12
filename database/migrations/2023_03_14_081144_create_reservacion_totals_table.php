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
            $table->string('Nombre_Cliente', 30);
            $table->string('Apellido_Cliente', 30);
            $table->string('Contacto', 9);
            $table->integer('Cantidad');  
            $table->string('Tipo_Reservacion');
            $table->string('Tipo_Evento', 50);
            $table->date('Fecha');
            $table->time('HoraEntrada');
            $table->time('HoraSalida');
            $table->string('FormaPago')->default(0);
            $table->boolean('estado')->default(0);
            $table->float('Total');
            $table->float('Anticipo');
            $table->float('Pendiente');
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
