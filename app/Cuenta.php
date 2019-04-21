<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Cuenta extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'cuenta';
    public $timestamps = true;
    public $primaryKey = 'email';
    protected $fillable = ['nombre', 'direccion', 'tipo', 'representante', 'telefono', 'email', 'ciudad', 'latitud', 'longitud', 'num_int', 'descripcion', 'password', 'remember_token', 'confirmada', 'confirmation_code'];
    protected $hidden = ['password', 'remember_token'];
    public function scopeName($query, $name){
        if(trim($name) != ""){
            $query->where('nombre', "LIKE", "%$name%");
        }

    }
}
