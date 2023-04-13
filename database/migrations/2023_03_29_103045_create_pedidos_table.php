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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('quiosco');
            $table->string('nombreCliente');
            $table->double('imp')->default('0');
            $table->double('total')->default('0');
            $table->string('estado')->default('0'); 
            $table->string('estado_cocina')->default('0'); 
            $table->unsignedBigInteger('mesa_id');
            $table->foreign('mesa_id')->references('id')->on('mesas')->onDelete('cascade');
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
        Schema::dropIfExists('pedidos');
    }
};
