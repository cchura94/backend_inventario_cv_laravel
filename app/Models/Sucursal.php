<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    public function usuarios(){
        return $this->belongsToMany(User::class);
    }

    public function almacenes(){
        return $this->hasMany(Almacen::class);
    }
}
