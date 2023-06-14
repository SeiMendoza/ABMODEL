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
        Schema::create('kiosko_reservacion', function (Blueprint $table) {
            $table->id();

            
            $table->unsignedBigInteger('reservacion_id');

            
            $table->foreign('reservacion_id')->references('id')->on('reservacions')->onUpdate('cascade')->onDelate('cascade');

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
        Schema::dropIfExists('kiosko_reservacion');
    }
};
