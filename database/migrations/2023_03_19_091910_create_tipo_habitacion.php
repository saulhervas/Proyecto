<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoHabitacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_habitacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion');
            $table->integer('tamanio');
            $table->integer('precio');
            $table->integer('num_personas');
            $table->integer('num_camas');
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
        Schema::dropIfExists('tipo_habitacion');
    }
}
