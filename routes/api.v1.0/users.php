<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('registerUser', [App\Http\Controllers\Security\RegisterUserController::class, 'create']);
Route::get('getUsers', [App\Http\Controllers\Security\UserController::class, 'getUsers']);
Route::get('deleteUser/{id}', [App\Http\Controllers\Security\UserController::class, 'deleteUser']);
