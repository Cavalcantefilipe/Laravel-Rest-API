<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
    protected $primaryKey = 'id';


    protected $fillable = [
        'nome',
        'pais'
    ];

    public $timestamps = false;


    protected $hidden = [];


    protected $casts = [

    ];
}
