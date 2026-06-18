<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sucursalId = isset($request->sucursal)?$request->sucursal:null;
        if(isset($sucursalId)){
            $almacenes = Almacen::where("sucursal_id", $sucursalId)->with(['sucursal'])->get();
        }else{

            $almacenes = Almacen::with(['sucursal'])->get();
        }

        return response()->json($almacenes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombre" => "required",
            "codigo" => "required",
            "sucursal_id" => "required"
            ]);
        // guardar
        $almacen = new Almacen();
        $almacen->nombre = $request->nombre;
        $almacen->descripcion = $request->descripcion;
        $almacen->codigo = $request->codigo;
        $almacen->nombre = $request->nombre;
        $almacen->sucursal_id = $request->sucursal_id;
        $almacen->save();

        return response()->json(["mensaje" => "ALmacen registrado"]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $almacen = Almacen::find($id);

        return response()->json($almacen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $almacen = Almacen::find($id);

        $almacen->nombre = $request->nombre;
        $almacen->descripcion = $request->descripcion;
        $almacen->codigo = $request->codigo;
        $almacen->nombre = $request->nombre;
        $almacen->sucursal_id = $request->sucursal_id;
        $almacen->update();

        return response()->json(["mensaje" => "Almacen actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
