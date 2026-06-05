<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
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

Route::middleware('auth:sanctum')->group(function(){
    
    // CRUD Usuarios Api Rest
     Route::apiresource("/usuario", UsuarioController::class);
     
     });
     
     Route::apiResource("/role", RoleController::class);

Route::get("/test", function(){
    
})->name('login');
