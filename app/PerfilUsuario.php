<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model
{
    // Table Name
    protected $table = 'PerfilUsuario';
    // Primary Key
    public $primaryKey = 'idPerfilUsuario';
    // Timestamps
    public $timestamps = false;
}
