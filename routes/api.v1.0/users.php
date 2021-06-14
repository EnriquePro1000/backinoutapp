<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('registerUser', [App\Http\Controllers\Security\CreateUserController::class, 'create']);
Route::post('editUser/{id}', [App\Http\Controllers\Security\EditUserController::class, 'edit']);
Route::get('getUser/{id}', [App\Http\Controllers\Security\UserController::class, 'getUser']);
Route::get('getUsers', [App\Http\Controllers\Security\UserController::class, 'getUsers']);
Route::get('deleteUser/{id}', [App\Http\Controllers\Security\UserController::class, 'deleteUser']);
