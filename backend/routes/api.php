<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function(){
    Route::post("register",[AuthController::class , "register"]);
    Route::post("login",[AuthController::class , "login"]);
});

Route::middleware("auth.jwt")->group(function(){
    Route::post("/class",[ClassController::class , "store"]);
    Route::get("/class",[ClassController::class , "getClass"]);
    Route::get("/class/menu" , [ClassController::class , "getClassMenu"]);
    Route::get("/class/{id}", [ClassController::class , "getClassDetail"]);
});

Route::get("/refresh",[AuthController::class , "refresh"])->middleware('refresh');
