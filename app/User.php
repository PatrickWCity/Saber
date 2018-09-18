<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// MustVerifyEmail for email verification
class User extends Authenticatable
{
    use Notifiable;

    // Table Name
    protected $table = 'Acceso';
    // Primary Key
    public $primaryKey = 'idAcceso';
    // Timestamps
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array //email for email verification
     */
    protected $fillable = [
        'username', 'password', 'diasClave', 'fechaCaducidad', 'estadoInicial', 'foto', 'estadoAcceso', 'idUsuario',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the user that owns the phone.
     */
    //public function usuario()
    //{
    //    return $this->belongsTo('App\Usuario');
    //}
}
