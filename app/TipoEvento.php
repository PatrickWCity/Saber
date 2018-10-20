<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEvento extends Model
{
    // Table Name
    protected $table = 'TipoEvento';
    // Primary Key
    public $primaryKey = 'idTipoEvento';
    // Timestamps
    public $timestamps = false;
}
