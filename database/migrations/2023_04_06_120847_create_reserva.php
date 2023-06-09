<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50);
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('habitacion_id');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->integer('num_adultos');
            $table->integer('num_ninios');
            $table->integer('num_habitaciones');
            $table->timestamps();

            $table->foreign('cliente_id', 'fk_reserva_cliente')->references('id')->on('cliente')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('habitacion_id', 'fk_habitacion_reserva')->references('id')->on('habitacion')->onDelete('restrict')->onUpdate('restrict');
            
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva');
    }
}
