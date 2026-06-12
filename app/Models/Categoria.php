<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // tablas categorias
     // protected $table = 'categorias';

     
    // rotected $primaryKey = 'idcat';
    // public $incrementing = false;
    // protected $keyType = 'string';

    public function productos(){
        return $this->hasMany(Producto::class);
    }



}
