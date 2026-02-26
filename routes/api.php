<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/status", function (){
    return \App\Services\ApiResponses::success('API sendo executada!');
});

Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])
    ->middleware('auth:sanctum');

Route::apiResource('clientes', ClienteController::class)
    ->middleware('auth:sanctum');
