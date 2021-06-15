<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('registerUser', [App\Http\Controllers\Security\CreateUserController::class, 'createUser']);
Route::post('editUser/{id}', [App\Http\Controllers\Security\EditUserController::class, 'editUser']);
Route::get('getUser/{id}', [App\Http\Controllers\Security\UserInteractorController::class, 'getUser']);
Route::get('getUsers', [App\Http\Controllers\Security\UserInteractorController::class, 'getUsers']);
Route::delete('deleteUser/{id}', [App\Http\Controllers\Security\UserInteractorController::class, 'deleteUser']);
