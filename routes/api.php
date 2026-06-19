<?php

use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ClienteproveedorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas Auth

Route::prefix('/v1/auth')->group(function(){

    Route::post("register", [AuthController::class, "funRegister"]);
    Route::post("login", [AuthController::class, "funLogin"]);
    
    Route::middleware('auth:sanctum')->group(function(){
    
        Route::get("profile", [AuthController::class, "funProfile"]);
        Route::post("logout", [AuthController::class, "funLogout"]);
    
    });
});

    Route::get("/producto/exportar/pdf", [ProductoController::class, "funExportarProductosPDF"]);

Route::middleware('auth:sanctum')->group(function(){
    
    // asignar role a usuario
    Route::post("/usuario/{id}/asignar_role", [UsuarioController::class, "asignarRole"]);
    // quitar rol a usuario
    Route::post("/usuario/{id}/quitar_role", [UsuarioController::class, "eliminarRole"]);
    // asignar permiso a rol
    Route::post("role/{id}/asignar_permiso", [RoleController::class, "asignarPermiso"]);
    
    // actualizar imagen de producto
    Route::post("/producto/{id}/actualiza-imagen", [ProductoController::class, "funActualizarImagen"]);
    
    // exportar archivo excel (Reporte Excel)
    Route::get("/producto/exportar/excel", [ProductoController::class, "funExportarProductosExcel"]);

    // exportar archivo pdf (Reporte PDF)



    // CRUD Usuarios Api Rest
     Route::apiresource("/usuario", UsuarioController::class);
     // CRUD Roles Api Rest
     Route::apiResource("/role", RoleController::class);
     // CRUD Permission Api Rest
     Route::apiResource("/permiso", PermissionController::class);

     // CRUD Categorias (SQL)
     Route::apiResource("/categoria", CategoriaController::class);

     // CRUD Sucursal (Query Builder)
     Route::apiResource("/sucursal", SucursalController::class);

     // CRUD Producto (Eloquent ORM)
    Route::apiResource("/producto", ProductoController::class);

    // CRUD ALmacen
    Route::apiResource("/almacen", AlmacenController::class);

    // CRUD clienteproveedores
    Route::apiResource('clienteproveedores', ClienteproveedorController::class);
    
 });
     
     

Route::get("/test", function(){
    
})->name('login');
