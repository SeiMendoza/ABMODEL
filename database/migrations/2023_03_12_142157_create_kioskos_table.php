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
        Schema::create('kioskos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo')->unique()->required();
            $table->string('descripcion');
            $table->integer('cantidad_de_Mesas')->required();
            $table->string('ubicacion')->nullable();
            $table->boolean('disponible')->default(1)->required(); // 1 para disponible 0 para no disponible
            $table->string('imagen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kioskos');
    }
};
