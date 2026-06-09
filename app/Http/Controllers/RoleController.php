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
        $roles = Role::get();

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

        return response()->json();
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

         $role = new Role();
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
}
