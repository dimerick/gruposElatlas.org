<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    public $timestamps = false;
    public $primaryKey = 'url';
    protected $fillable = ['actividad', 'url'];
}
