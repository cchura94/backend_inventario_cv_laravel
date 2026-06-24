<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Electrónica',
                'descripcion' => 'Productos electrónicos y tecnológicos',
            ],
            [
                'nombre' => 'Ropa',
                'descripcion' => 'Prendas de vestir para todas las edades',
            ],
            [
                'nombre' => 'Hogar',
                'descripcion' => 'Artículos para el hogar',
            ],
            [
                'nombre' => 'Deportes',
                'descripcion' => 'Equipamiento y accesorios deportivos',
            ],
            [
                'nombre' => 'Libros',
                'descripcion' => 'Libros y material educativo',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
