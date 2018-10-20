<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoNoticia extends Model
{
    // Table Name
    protected $table = 'TipoNoticia';
    // Primary Key
    public $primaryKey = 'idTipoNoticia';
    // Timestamps
    public $timestamps = false;
}
