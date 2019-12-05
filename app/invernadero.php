<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invernadero extends Model
{
    //
    public $timestamps = false;
    
    protected $table='invernadero';
    protected $fillable = [
        'id','cultivo','caracteristicas','placa','usuario_id_usuario'
    ];
}
