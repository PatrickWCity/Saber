<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoVoluntario extends Model
{
    // Table Name
    protected $table = 'TipoVoluntario';
    // Primary Key
    public $primaryKey = 'idTipoVoluntario';
    // Timestamps
    public $timestamps = false;
}
