<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clienteproveedor extends Model
{

    protected $fillable = [
        'tipo',
        'razon_social',
        'nro_identificacion',
        'telefono',
        'direccion',
        'correo',
        'estado',
    ];

    public function notas(){
        return $this->hasMany(Nota::class);
    }
}
