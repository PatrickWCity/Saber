<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    // Table Name
    protected $table = 'Noticia';
    // Primary Key
    public $primaryKey = 'idNoticia';
    // Custom Timestamps
    const CREATED_AT = 'fechaCreada';
    const UPDATED_AT = 'fechaActualizada';
}
