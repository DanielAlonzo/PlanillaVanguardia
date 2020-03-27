<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deducciones extends Model
{
    //
    protected $fillable=[
        'deduccion', 'monto', 'tipo', 
    ];
    protected $table="pagos_deducciones";
}
