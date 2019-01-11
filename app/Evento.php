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

    public function tipoevento() {
        return $this->belongsTo('App\TipoEvento','idTipoEvento');
    }
    public function sede() {
        return $this->belongsTo('App\Sede','idSede');
    }
    public function expositor() {
        return $this->belongsTo('App\Expositor','idExpositor');
    }
    public function area() {
        return $this->belongsTo('App\Area','idArea');
    }
}
