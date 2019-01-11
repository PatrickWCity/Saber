<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submodulo extends Model
{
    // Table Name
    protected $table = 'Submodulo';
    // Primary Key
    public $primaryKey = 'idSubmodulo';
    // Timestamps
    public $timestamps = false;

    public function submodulomodulo() {
        return $this->belongsTo('App\SubmoduloModulo','idSubmoduloModulo');
    }
}
