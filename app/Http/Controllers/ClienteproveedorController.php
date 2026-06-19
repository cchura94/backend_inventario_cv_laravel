<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Clienteproveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteproveedorController extends Controller
{
    /**
     * Listado
     */
    public function index()
    {
        $clienteproveedores = Clienteproveedor::orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $clienteproveedores
        ]);
    }

    /**
     * Crear
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => ['required', Rule::in(['Cliente', 'Proveedor'])],
            'razon_social' => 'required|max:200',
            'nro_identificacion' => 'nullable|max:100',
            'telefono' => 'required|max:20',
            'direccion' => 'nullable',
            'correo' => 'required|email|max:200',
            'estado' => 'required|boolean',
        ]);

        $clienteproveedor = Clienteproveedor::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Registro creado correctamente',
            'data' => $clienteproveedor
        ], 201);
    }

    /**
     * Mostrar uno
     */
    public function show(string $id)
    {
        $clienteproveedor = Clienteproveedor::find($id);

        if (!$clienteproveedor) {
            return response()->json([
                'success' => false,
                'message' => 'Registro no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $clienteproveedor
        ]);
    }

    /**
     * Actualizar
     */
    public function update(Request $request, string $id)
    {
        $clienteproveedor = Clienteproveedor::find($id);

        if (!$clienteproveedor) {
            return response()->json([
                'success' => false,
                'message' => 'Registro no encontrado'
            ], 404);
        }

        $request->validate([
            'tipo' => ['required', Rule::in(['Cliente', 'Proveedor'])],
            'razon_social' => 'required|max:200',
            'nro_identificacion' => 'nullable|max:100',
            'telefono' => 'required|max:20',
            'direccion' => 'nullable',
            'correo' => 'required|email|max:200',
            'estado' => 'required|boolean',
        ]);

        $clienteproveedor->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Registro actualizado correctamente',
            'data' => $clienteproveedor
        ]);
    }

    /**
     * Eliminar
     */
    public function destroy(string $id)
    {
        $clienteproveedor = Clienteproveedor::find($id);

        if (!$clienteproveedor) {
            return response()->json([
                'success' => false,
                'message' => 'Registro no encontrado'
            ], 404);
        }

        $clienteproveedor->estado = false;
        $clienteproveedor->update();

        return response()->json([
            'success' => true,
            'message' => 'Registro eliminado correctamente'
        ]);
    }
}