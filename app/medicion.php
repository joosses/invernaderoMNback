<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medicion extends Model
{
    // 
    public $timestamps = false;
    
    protected $table='medicion';
    protected $fillable = [
        'id','valor','tiempo','chipid','nombre'
    ];
}
