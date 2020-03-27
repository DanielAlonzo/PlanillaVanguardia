<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    //
    protected $fillable=[
        'nombre', 'hora_entrada', 'hora_salida', 
    ];

    //protected $table="horarios";
}
