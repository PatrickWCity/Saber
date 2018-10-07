<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

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
        'username', 'password', 'email', 'diasClave', 'fechaCaducidad', 'estadoInicial', 'foto', 'estadoAcceso', 'idUsuario',
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
    
    // PerfilUsuario
    public function roles()
    {
        return $this->belongsToMany('App\Perfil', 'PerfilUsuario', 'idUsuario', 'idPerfil');
    }
    // Consulta si el Usuario tiene el Perfil
    public function tienePerfil(string $role)
    {
        return $this->roles()->where('nombre', $role)->count() == 1;
    }
}
