<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_reserva', function (Blueprint $table) {
            $table->unsignedBigInteger('reserva_id');
            $table->unsignedBigInteger('servicio_id');

            $table->foreign('reserva_id', 'fk_servicioreserva_reserva')->references('id')->on('reserva')->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('servicio_id','fk_servicioreserva_servicio')->references('id')->on('servicio')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio_reserva');
    }
}
