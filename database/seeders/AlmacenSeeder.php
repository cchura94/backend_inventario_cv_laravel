<?php

namespace Database\Seeders;

use App\Models\Almacen;
use App\Models\Sucursal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $central = Sucursal::where('nombre', 'Sucursal Central')->first();
        $sur = Sucursal::where('nombre', 'Sucursal Sur')->first();
        $cbba = Sucursal::where('nombre', 'Sucursal Cochabamba')->first();

        Almacen::insert([
            [
                'nombre' => 'Almacén Principal',
                'codigo' => 'ALM-001',
                'descripcion' => 'Almacén principal de productos',
                'sucursal_id' => $central->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Almacén Secundario',
                'codigo' => 'ALM-002',
                'descripcion' => 'Almacén de respaldo',
                'sucursal_id' => $central->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Almacén Zona Sur',
                'codigo' => 'ALM-003',
                'descripcion' => 'Almacén de la sucursal sur',
                'sucursal_id' => $sur->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Almacén Cochabamba',
                'codigo' => 'ALM-004',
                'descripcion' => 'Almacén regional',
                'sucursal_id' => $cbba->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
