<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Listar Categorias.
     */
    public function index()
    {
        // SQL
        // $categorias = DB::select("Select * from categorias");
        $categorias = Categoria::get();
        return response()->json($categorias, 200);
        // DB::insert("");
        // DB::update("");
        // DB::delete("");
        // DB::statement("");

    }

    /**
     * Guardar nueva categoria
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required"
        ]);
        // SQL
        DB::insert("INSERT INTO categorias(nombre, descripcion) values(?,?)", [$request->nombre, $request->descripcion]);
        return response()->json(["mensaje" => "Categoria Registrada"], 201);
    }

    /**
     * Mostrar una categoria por id
     */
    public function show(string $id)
    {
        $categoria = DB::select("select * from categorias where id=?", [$id]);

        if(empty($categoria)){
            return response()->json(["mensaje" => "Categoria no encontrada"], 404);
        }

        return response()->json($categoria[0], 200);
        
    }

    /**
     * Modificar categoria por id
     */
    public function update(Request $request, string $id)
    {
        $res = DB::update("UPDATE categorias set nombre= ?, descripcion=? where id = ?", [$request->nombre, $request->descripcion, $id]);

        if($res === 0){
            return response()->json(["mensaje" => "Categoria no encontrada"], 404);
        }

        return response()->json(["mensaje" => "Categoria actualizada correctamente"]);

    }

    /**
     * Eliminar una categoria por id
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return response()->json(["mensaje" => "Categoria Eliminada"], 200);
    }
}
