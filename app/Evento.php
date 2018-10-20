<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    // Table Name
    protected $table = 'Evento';
    // Primary Key
    public $primaryKey = 'idEvento';
    // Timestamps
    public $timestamps = false;
}
