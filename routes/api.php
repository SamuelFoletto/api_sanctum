<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/status", function (){
    return response()->json([
        "status" => "Executando",
        "message" => "API está rodando corretamente!"
    ],
        200
    );

});

Route::apiResource('clientes', ClienteController::class);
