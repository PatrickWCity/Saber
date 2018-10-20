<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    // Table Name
    protected $table = 'Voluntario';
    // Primary Key
    public $primaryKey = 'idVoluntario';
    // Timestamps
    public $timestamps = false;
}
