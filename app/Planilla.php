<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    //
    protected $fillable=[
        'nombre', 'fecha', 'tipo', 'periodo',
    ];
    protected $table="planilla";
}
