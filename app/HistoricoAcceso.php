<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoAcceso extends Model
{
    // Table Name
    protected $table = 'HistoricoAcceso';
    // Primary Key
    public $primaryKey = 'idHistoricoAcceso';
    // Timestamps
    public $timestamps = false;
}
