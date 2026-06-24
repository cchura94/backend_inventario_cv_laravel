<?php

namespace Database\Seeders;

use App\Models\Clienteproveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteproveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Clienteproveedor::insert([
            // Clientes
            [
                'tipo' => 'Cliente',
                'razon_social' => 'Juan Pérez',
                'nro_identificacion' => '1234567 LP',
                'telefono' => '71234567',
                'direccion' => 'Zona Central, La Paz',
                'correo' => 'juan.perez@gmail.com',
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'Cliente',
                'razon_social' => 'María Gómez',
                'nro_identificacion' => '7654321 CB',
                'telefono' => '72345678',
                'direccion' => 'Cochabamba',
                'correo' => 'maria.gomez@gmail.com',
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Proveedores
            [
                'tipo' => 'Proveedor',
                'razon_social' => 'Importadora Tecnológica SRL',
                'nro_identificacion' => 'NIT-123456789',
                'telefono' => '22112233',
                'direccion' => 'Av. Camacho #100, La Paz',
                'correo' => 'ventas@importadora.com',
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'Proveedor',
                'razon_social' => 'Distribuidora Bolivia SA',
                'nro_identificacion' => 'NIT-987654321',
                'telefono' => '33445566',
                'direccion' => 'Av. Banzer #500, Santa Cruz',
                'correo' => 'contacto@distribuidora.com',
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'Proveedor',
                'razon_social' => 'Papelería Nacional',
                'nro_identificacion' => 'NIT-456789123',
                'telefono' => '22334455',
                'direccion' => 'Calle Comercio #250, La Paz',
                'correo' => 'ventas@papeleria.com',
                'estado' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
