<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clienteproveedor extends Model
{
    public function notas(){
        return $this->hasMany(Nota::class);
    }
}
