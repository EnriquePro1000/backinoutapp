<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
