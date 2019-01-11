<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmoduloModulo extends Model
{
    // Table Name
    protected $table = 'SubmoduloModulo';
    // Primary Key
    public $primaryKey = 'idSubmoduloModulo';
    // Timestamps
    public $timestamps = false;

    public function submodulos() {
        return $this->hasMany('App\Submodulo','idSubmodulo');
    }
    public function modulos() {
        return $this->hasMany('App\Modulo','idModulo');
    }
}
