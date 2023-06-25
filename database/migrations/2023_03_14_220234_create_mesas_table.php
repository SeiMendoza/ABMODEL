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
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 7);
            $table->string('nombre', 50);
            $table->integer('cantidad');
            $table->unsignedBigInteger('kiosko_id');
            $table->foreign("kiosko_id")->references("id")->on("kioskos")->onDelete('cascade');
            $table->foreign("id")->references("id")->on("kioskos")->onDelete('cascade');
            $table->boolean('estadoM')->default(0);
            $table->binary('mesa_qr');
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
        Schema::dropIfExists('mesas');
    }
};
