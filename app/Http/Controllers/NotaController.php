<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validacion
        $request->validate([
            "tipo_nota" => "required|in:venta,compra,devolucion",
            "clienteproveedor_id" => "required|exists:clienteproveedors,id",
            "observaciones" => "nullable",
            "movimientos.*.almacen_id" => "required|exists:almacens,id",
            "movimientos.*.producto_id" => "required|exists:productos,id",
            "movimientos.*.cantidad" => "required|integer|min:1",
            "movimientos.*.tipo_movimiento" => "required|in:ingreso,salida,devolucion",
            "movimientos.*.precio_compra" => "required|numeric",
            "movimientos.*.precio_venta" => "required|numeric",
            "movimientos.*.observaciones" => "nullable|string"
        ]);

        // transaction
        try {
            DB::beginTransaction();
            // registrar Nota
            $nota = new Nota();
            $nota->fecha = date('Y-m-d H:i:s');
            $nota->tipo_nota = $request->tipo_nota;
            $nota->observaciones = $request->observaciones;
            $nota->clienteproveedor_id = $request->clienteproveedor_id;
            $nota->user_id = Auth::user()->id; // Auth::id();
            $nota->save();
            
            // actualizar stock productos
            foreach ($request->movimientos as $mov) {
                $nota->movimientos()->attach($mov['almacen_id'], 
                [
                    'producto_id' => $mov['producto_id'],
                    'cantidad' => $mov['cantidad'],
                    'tipo_movimiento' => $mov['tipo_movimiento'],
                    'precio_compra' => $mov['precio_compra'],
                    'precio_venta' => $mov['precio_venta'],
                    "observaciones" => $mov["observaciones"]
                ]);

                // actualizar Stock
                $pivot = DB::table('almacen_producto')
                            ->where("almacen_id", $mov['almacen_id'])
                            ->where('producto_id', $mov['producto_id'])
                            ->first();
                
                if(!$pivot){
                    if($mov['tipo_movimiento'] === 'salida'){
                        // si quiere vender
                        throw new \Exception("No hay stock para salida en este almacen y producto");
                    }
                    
                    // si quiere comprar
                    DB::table("almacen_producto")->insert([
                        "almacen_id" => $mov['almacen_id'],
                        "producto_id" => $mov['producto_id'],
                        "cantidad_actual" => $mov['cantidad']
                    ]);
                }else{
                    $nuevaCantidad = $pivot->cantidad_actual;

                    if($mov['tipo_movimiento'] === 'ingreso' || $mov['tipo_movimiento'] === 'devolucion'){
                        $nuevaCantidad = $nuevaCantidad + $mov['cantidad'];
                    }elseif($mov['tipo_movimiento']==='salida'){
                        if($pivot->cantidad_actual < $mov['cantidad']){
                            throw new \Exception("Stock insuficiente en salida");
                        }
                        $nuevaCantidad = $nuevaCantidad - $mov['catidad'];
                    }

                    DB::table("almacen_producto")->where("almacen_id", $mov['almacen_id'])
                                                ->where("producto_id", $mov['producto_id'])
                                                ->update([
                                                    "cantidad_actual" => $nuevaCantidad
                                                ]);
                }
            }
            // registrar ingreso salida
            DB::commit();
            
            return response()->json(["mensaje" => "Nota creada correctamente"], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["mensaje" => "Error al registrar la nota", "error" => $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
