<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoClave extends Model
{
    // Table Name
    protected $table = 'HistoricoClave';
    // Primary Key
    public $primaryKey = 'idHistoricoClave';
    // Timestamps
    public $timestamps = false;
}
