<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\user\DeviceController;
use App\Http\Controllers\Api\user\RoomController;
use App\Http\Controllers\Api\user\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthApiController::class,'login']);
Route::middleware('auth:sanctum')->group(function(){
    Route::resource('rooms',RoomController::class);
    Route::resource('devices',DeviceController::class);
    Route::resource('types',TypeController::class);
    
});