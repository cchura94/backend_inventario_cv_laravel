<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    public function productos(){
        return $this->belongsToMany(Producto::class);
    }

    public function sucursales(){
        return $this->belongsToMany(Sucursal::class);
    }
}
