<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->string('descripcion')->nullable()->default('Ubicacion predeterminada');
            $table->integer('cantidad_de_Mesas')->required()->default(1);
            $table->string('ubicacion')->nullable();
            $table->string('imagen')->default('/img/LoremKiosko.png');
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
