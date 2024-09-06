<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

Route::middleware('auth:sanctum')->group( function () { 
 Route::post('store-task', [ApiController::class, 'storeTask']);
 Route::get('/tasks', [ApiController::class, 'tasks']);
 Route::get('/task/{id}', [ApiController::class, 'task']);
 Route::patch('/task-update/{id}', [ApiController::class, 'taskUpdate']);
 Route::delete('/task-delete/{id}', [ApiController::class, 'taskDelete']);
});