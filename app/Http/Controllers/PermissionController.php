<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permisos = Permission::paginate(10);
        return response()->json($permisos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required|string|unique:permissions"
        ]);

        $permiso = new Permission();
        $permiso->nombre = $request->nombre;
        $permiso->detalle = $request->detalle;
        $permiso->save();

        return response()->json(["mensaje" => "Permiso registrado correctamente"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permiso = Permission::find($id);

        return response()->json($permiso, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "nombre" => "required|string|unique:permissions,nombre,".$id
        ]);

        $permiso = Permission::find($id);
        $permiso->nombre = $request->nombre;
        $permiso->detalle = $request->detalle;
        $permiso->update();

        return response()->json(["mensaje" => "Permiso Actualizado"], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permiso = Permission::find($id);
        $permiso->delete();

        return response()->json(["mensaje" => "Permiso Eliminado"]);
    }
}
