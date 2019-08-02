<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    protected $table = 'estudiantes';
    public $timestamps= false;
    protected $fillable = [
        'nombre','apellido','cedula','nivelid',
    ];
}
