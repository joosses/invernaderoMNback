<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class variable extends Model
{
    //
    public $timestamps = false;
    
    protected $table='variable';
    protected $fillable = [
        'id','sensor_id_sensor','medicion_id_medicion'
    ];
}
