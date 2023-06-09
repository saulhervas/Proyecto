<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 200);
            $table->string('apellidos', 200)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo', 50)->nullable();
            $table->string('dni',20)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('foto', 200)->nullable();
            $table->integer('codigo_postal')->nullable();
            $table->integer('localidad')->nullable();
            $table->integer('provincia')->nullable();
            $table->integer('pais')->nullable();
            $table->integer('telefono')->nullable();
            $table->string('email');
            $table->unsignedInteger('usuario_id')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id', 'fk_cliente_usuario')->references('id')->on('usuario')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('cliente');
    }
}
