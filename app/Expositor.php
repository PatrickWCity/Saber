<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expositor extends Model
{
    // Table Name
    protected $table = 'Expositor';
    // Primary Key
    public $primaryKey = 'idExpositor';
    // Timestamps
    public $timestamps = false;

    public function eventos() {
        return $this->hasMany('App\Evento','idEvento');
    }
}
