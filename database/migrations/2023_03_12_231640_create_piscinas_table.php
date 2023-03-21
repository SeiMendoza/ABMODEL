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
        Schema::create('piscinas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('tipo');
            $table->foreign("tipo")->references("id")->on("piscina_tipos");
            $table->date('fecha_expiracion');
            $table->decimal('peso');
            $table->unsignedBigInteger('uso');
            $table->foreign("uso")->references("id")->on("piscina_usos");
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
        Schema::dropIfExists('piscinas');
    }
};
