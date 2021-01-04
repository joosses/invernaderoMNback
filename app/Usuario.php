<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use Notifiable;
    protected $table = 'usuario';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'apellido', 'telefono', 'direccion', 'ciudad', 'correo', 'contrasena', 'rol_id_rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'contrasena', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relacion uno a muchos de usuario-invernadero
    public function invernaderos()
    {
        $this->hasMany(Invernadero::class);
    }
}
