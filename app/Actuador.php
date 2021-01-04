<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actuador extends Model
{
    public $timestamps = false;

    protected $table = 'actuador';
    protected $fillable = [
        'id', 'estado', 'nombre', 'caracteristica', 'invernadero_id_invernadero'
    ];
}
