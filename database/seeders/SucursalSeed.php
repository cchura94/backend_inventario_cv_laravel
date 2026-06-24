<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SucursalSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sucursales = [
            [
                'nombre' => 'Sucursal Central',
                'direccion' => 'Av. Mariscal Santa Cruz #123',
                'telefono' => '22123456',
                'ciudad' => 'La Paz',
            ],
            [
                'nombre' => 'Sucursal Sur',
                'direccion' => 'Calle 21 de Calacoto #456',
                'telefono' => '22334455',
                'ciudad' => 'La Paz',
            ],
            [
                'nombre' => 'Sucursal Cochabamba',
                'direccion' => 'Av. Heroínas #789',
                'telefono' => '44223344',
                'ciudad' => 'Cochabamba',
            ],
            [
                'nombre' => 'Sucursal Santa Cruz',
                'direccion' => 'Av. Cristo Redentor #321',
                'telefono' => '33445566',
                'ciudad' => 'Santa Cruz',
            ],
        ];

        foreach ($sucursales as $sucursal) {
            Sucursal::create($sucursal);
        }
    }
}
