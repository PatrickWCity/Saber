<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    // Table Name
    protected $table = 'Perfil';
    // Primary Key
    public $primaryKey = 'idPerfil';
    // Timestamps
    public $timestamps = false;
}
