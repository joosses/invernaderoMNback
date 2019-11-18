<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class auto extends Model
{
    protected $table='marca';
    
    protected $fillable = [
        'id','nombre','origen'
    ];
}
