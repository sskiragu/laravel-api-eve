<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    // Route::get('/dashboard/profile', [ProfileController::class, 'index']);
    // Route::get('/dashboard/profile/{id}', [ProfileController::class, 'index']);
    // Route::post('/dashboard/profile', [ProfileController::class, 'store']);
    // Route::patch('/dashboard/profile/{id}', [ProfileController::class, 'update']);
    // Route::delete('/dashboard/profile/{id}', [ProfileController::class, 'destroy']);

    Route::apiResource('/dashboard/profile', ProfileController::class);

});

