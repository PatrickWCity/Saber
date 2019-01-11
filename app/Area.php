<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    // Table Name
    protected $table = 'Area';
    // Primary Key
    public $primaryKey = 'idArea';
    // Timestamps
    public $timestamps = false;

    public function eventos() {
        return $this->hasMany('App\Evento','idEvento');
    }
}
