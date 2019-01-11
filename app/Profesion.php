<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    // Table Name
    protected $table = 'Profesion';
    // Primary Key
    public $primaryKey = 'idProfesion';
    // Timestamps
    public $timestamps = false;

    public function voluntarios() {
        return $this->hasMany('App\Voluntario','idVoluntario');
    }
}
