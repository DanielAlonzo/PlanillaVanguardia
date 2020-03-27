<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla_detalle', function (Blueprint $table) {
            $table->integer('id_planilla')->unsigned();
            $table->foreign('id_planilla')->references('id_planilla')->on('planilla');
            $table->integer('id_empleado')->unsigned();
            $table->foreign('id_empleado')->references('id')->on('empleados');
            $table->integer('id_deducciones')->unsigned();
            $table->foreign('id_deducciones')->references('id_deducciones')->on('pagos_deducciones');
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
        Schema::dropIfExists('planilla_detalle');
    }
}
