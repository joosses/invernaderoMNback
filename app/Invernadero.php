<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invernadero extends Model
{
    public $timestamps = false;

    protected $table = 'invernadero';

    protected $fillable = [
        'id', 'cultivo', 'caracteristicas', 'placa', 'usuario_id_usuario', 'chipid', 'estado'
    ];
}
