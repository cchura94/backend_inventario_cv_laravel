<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    // tablas categorias
     // protected $table = 'categorias';

     
    // rotected $primaryKey = 'idcat';
    // public $incrementing = false;
    // protected $keyType = 'string';

    public function productos(){
        return $this->hasMany(Producto::class);
    }



}
