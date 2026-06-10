<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with(["permisos"])->get();

        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required"
        ]);

        $role = new Role();
        $role->nombre = $request->nombre;
        $role->detalle = $request->detalle;
        $role->save();

        return response()->json(["mensaje" => "Role registrado"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);

        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);

        $role->nombre = $request->nombre;
        $role->detalle = $request->detalle;
        $role->update();

        return response()->json(["message" => "role actualizado"], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();

        return response()->json(["el role fue eliminado"]);
    }

    public function asignarPermiso(Request $request, $id){
        $role = Role::find($id);
        $role->permisos()->sync($request->permisos);

        return response()->json(["mensaje" => "permisos Asignados"]);
    }
}
