<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $fillable = [
        'identidad', 'nombre', 'fecha_ingreso','fecha_salida', 'salario_base', 
        'id_departamento', 'id_puesto', 'id_horario',
    ];
}
