<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Lista de productos.
     */
    public function index(Request $request)
    {
        $limit = isset($request->limit)?$request->limit:10;
        $estado = isset($request->estado)?$request->estado:null;
        $almacenId = isset($request->almacen)?$request->almacen:null;

        $productos = Producto::query();

        if(isset($estado)){
            $productos = $productos->where("estado", "=", $estado);
        }

        if(isset($request->search)){
            $search = $request->search;

            $productos = $productos->where("nombre", "Like", "%$search%")
                                    ->orWhere("descripcion", "Like", "%$search%");
        }

        if(isset($almacenId)){
            $productos = $productos->whereHas("almacenes", function($query) use ($almacenId){
                $query->where("almacens.id", "=", $almacenId);
            });
        }

        $productos = $productos->with(["categoria", "almacenes"])->orderBy("id", "desc")->paginate($limit);

        return response()->json($productos, 200);
    }

    /**
     * Guardar Producto
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required",
            "categoria_id" => "required|exists:categorias,id"
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio_venta_actual = $request->precio_venta_actual;
        $producto->estado = $request->estado;
        $producto->categoria_id = $request->categoria_id;
        $producto->save();

        return response()->json(["mensaje" => "Producto Registrado"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::with(["categoria"])->find($id);
        return response()->json($producto, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validar
         $request->validate([
            "nombre" => "required",
            "categoria_id" => "required|exists:categorias,id"
        ]);

        // buscar por id
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio_venta_actual = $request->precio_venta_actual;
        $producto->estado = $request->estado;
        $producto->categoria_id = $request->categoria_id;
        $producto->update();

        return response()->json(["mensaje" => "Producto Modificado"], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);

        $producto->estado = false;

        $producto->update();

        return response()->json(["mensaje" => "Producto Inactivo"], 201);

    }

    public function funActualizarImagen($id, Request $request){
        $request->validate(
            [
                "imagen" => "required|image|mimes:jpeg,png,jpg,gif|max:2048"
            ]
        );

        if($file = $request->file("imagen")){
            $direccion_url = time()."-".$file->getClientOriginalName();
            $file->move("imagenes", $direccion_url);

            $producto = Producto::find($id);
            $producto->imagen = "imagenes/".$direccion_url;
            $producto->update();

            return response()->json($producto);

        }
    }

}
