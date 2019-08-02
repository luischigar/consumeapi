<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'nivel';
    public $timestamps= false;
    protected $fillable = [
        'descripcion',
    ];
}
