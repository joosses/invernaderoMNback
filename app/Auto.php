<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    protected $table = 'marca';

    protected $fillable = [
        'id', 'nombre', 'origen'
    ];
}
