<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SucursalController extends Controller
{
    /**
     * Lista de sucursales.
     */
    public function index()
    {
        // Query Builder
        $sucursales = DB::table("sucursals")->get();

        return response()->json($sucursales);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombre" => "required",
            "direccion" => "required",
            "telefono" => "required",
            "ciudad" => "required",
        ]);
        // guardar
        DB::table("sucursals")->insert($request->all());

        return response()->json(["mensaje" => "Sucursal registrado"], 201);

    }

    /**
     * Mostrar Sucursal por id
     */
    public function show(string $id)
    {
        $sucursal = DB::table("sucursals")->find($id);

        return response()->json($sucursal, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validar
        $request->validate([
            "nombre" => "required",
            "direccion" => "required",
            "telefono" => "required",
            "ciudad" => "required",
        ]);
        DB::table("sucursals")->where("id", "=", $id)->update($request->all());

        return response()->json(["mensaje" => "Sucursal Actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
