<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    // Table Name
    protected $table = 'Documento';
    // Primary Key
    public $primaryKey = 'idDocumento';
    // Timestamps
    public $timestamps = false;

    public function tipodocumento() {
        return $this->belongsTo('App\TipoDocumento','idTipoDocumento');
    }
}
