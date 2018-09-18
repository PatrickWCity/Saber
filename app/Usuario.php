<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // Table Name
    protected $table = 'Usuario';
    // Primary Key
    public $primaryKey = 'idUsuario';
    // Timestamps
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'run', 'nombre','appat','apmat','direccion', 'telefono', 'email',
    ];

    /**
     * Get the phone record associated with the user.
     */
    //public function acceso()
    //{
    //    return $this->hasOne('App\User', 'idUsuario');
    //}
}
