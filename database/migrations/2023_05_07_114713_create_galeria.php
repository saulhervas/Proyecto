<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria', function (Blueprint $table) {
            $table->id();
            $table->string('foto', 200);
            $table->unsignedBigInteger('tipo_habitacion_id')->nullable();
            $table->unsignedBigInteger('servicio_id')->nullable();
            $table->string('referencia_vista', 50)->nullable();
            $table->timestamps();

            $table->foreign('tipo_habitacion_id', 'fk_tipohabitacion_galeria')->references('id')->on('tipo_habitacion')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('servicio_id', 'fk_servicio_galeria')->references('id')->on('servicio')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('galeria');
    }
}
