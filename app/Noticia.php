<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    // Table Name
    protected $table = 'Noticia';
    // Primary Key
    public $primaryKey = 'idNoticia';
}
