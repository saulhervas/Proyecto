<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_habitacion_id');
            $table->string('numero', 50);
            $table->tinyInteger('disponible')->default(1);
            $table->timestamps();

            $table->foreign('tipo_habitacion_id', 'fk_tipohabitacion_habitacion')->references('id')->on('tipo_habitacion')->onDelete('restrict')->onUpdate('cascade');
            
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
        Schema::dropIfExists('habitacion');
    }
}
