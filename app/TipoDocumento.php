<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    // Table Name
    protected $table = 'TipoDocumento';
    // Primary Key
    public $primaryKey = 'idTipoDocumento';
    // Timestamps
    public $timestamps = false;

    public function documentos() {
        return $this->hasMany('App\Documento','idDocumento');
    }
}
