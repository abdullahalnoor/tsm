<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () { 
  Route::get('/user-details', [AuthController::class, 'userDetails']);
  Route::post('logout', [AuthController::class, 'logout']);
});