<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    // Table Name
    protected $table = 'Noticia';
    // Primary Key
    public $primaryKey = 'idNoticia';
    // Timestamps
    public $timestamps = false;

    public function tiponoticia() {
        return $this->belongsTo('App\TipoNoticia','idTipoNoticia');
    }
}
