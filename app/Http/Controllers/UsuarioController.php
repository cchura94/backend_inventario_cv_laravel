<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // listar
        $usuarios = User::get(); // select * from users

        return response()->json($usuarios);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:6"
        ]);
        // guardar
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return response()->json($usuario, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // mostrar
       $usuario = User::findOrFail($id); // select * from users where id = $id

        return response()->json($usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validar
        $request->validate([
            "name" => "string",
            "email" => "email|unique:users,email",
            "password" => "string|min:6"
        ]);
            
            // modificar
        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if($request->password){
            $usuario->password = bcrypt($request->password);
        }
        $usuario->update();

        return response()->json($usuario, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // eliminar
        User::destroy($id); // delete from users where id = $id
        return response()->json(null, 204);
    }
}
