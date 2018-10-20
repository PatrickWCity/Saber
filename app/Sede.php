<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    // Table Name
    protected $table = 'Sede';
    // Primary Key
    public $primaryKey = 'idSede';
    // Timestamps
    public $timestamps = false;
}
