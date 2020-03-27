<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identidad');
            $table->string('nombre');
            $table->datetime('fecha_ingreso');
            $table->datetime('fecha_salida');
            $table->double('salario_base');
            $table->integer('id_departamento')->unsigned();
            $table->foreign('id_departamento')->references('id_departamento')->on('departamentos');
            $table->integer('id_puesto')->unsigned();
            $table->foreign('id_puesto')->references('id_puestos')->on('puestos');
            $table->integer('id_horario')->unsigned();
            $table->foreign('id_horario')->references('id_horario')->on('horarios');
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
        Schema::dropIfExists('empleados');
    }
}
