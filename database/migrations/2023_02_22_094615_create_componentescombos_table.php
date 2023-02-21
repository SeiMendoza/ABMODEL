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
        Schema::create('componentescombos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_complemento');
            //$table->foreign("id_complemento")->references("id")->on("platillosbebidas");
            $table->integer('cantidad');
            $table->unsignedBigInteger('id_combo');
            $table->foreign("id_combo")->references("id")->on("combos");
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
        Schema::dropIfExists('componentescombos');
    }
};
