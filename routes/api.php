<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

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

//Public routes
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'role:user']], function(){
    Route::apiResource('/dashboard/profile', ProfileController::class);
    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function(){
    Route::get('/admin/dashboard/profile', [AdminProfileController::class, 'index']);
});

Route::group(['middleware' => ['auth:sanctum', 'role:manager']], function(){
    Route::get('/manager/dashboard/profile', [AdminProfileController::class, 'index']);
});

