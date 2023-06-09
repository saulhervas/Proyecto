<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 200);
            $table->dateTime('inicio')->nullable();
            $table->dateTime('fin')->nullable();
            $table->tinyInteger('allDay')->default(0);
            $table->string('estado', 50)->nullable();
            $table->unsignedInteger('usuario_id')->nullable();
            $table->foreign('usuario_id', 'fk_eventousuario_usuario')->references('id')->on('usuario')->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
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
        Schema::dropIfExists('evento');
    }
}
