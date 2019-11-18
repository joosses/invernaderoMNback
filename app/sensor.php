<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sensor extends Model
{
    //
    public $timestamps = false;
    
    protected $table='sensor';
    protected $fillable = [
        'id','nombre','estado','caracteristica','invernadero_id_invernadero','tiempo'
    ];
}
