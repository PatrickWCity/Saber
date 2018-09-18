<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    // Table Name
    protected $table = 'Modulo';
    // Primary Key
    public $primaryKey = 'idModulo';
    // Timestamps
    public $timestamps = false;
}
