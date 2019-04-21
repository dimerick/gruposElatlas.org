<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividad';
    public $timestamps = true;
    public $primaryKey = 'id';
    protected $fillable = ['grupo', 'tipo', 'titulo', 'fecha', 'descripcion', 'categoria', 'latitud', 'longitud', 'confirmada'];
}
