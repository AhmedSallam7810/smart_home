<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\user\DeviceController;
use App\Http\Controllers\Api\user\RoomController;
use App\Http\Controllers\Api\user\TypeController;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\user\ESPController;

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

Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);
Route::middleware('auth:user')->group(function () {

    Route::get('rooms/{id}/devices', [DeviceController::class, 'allByRoom']);
    Route::resource('rooms', RoomController::class);
    Route::resource('devices', DeviceController::class);
    Route::get('types', [TypeController::class, 'index']);

});


//---------------------- ESP Integration ------------------------------------------------------------------------------------------------------

Route::get('user/{user_id}/room/{room_id}', [ESPController::class, 'getAllDeviceInRoom']);
Route::post('user/{user_id}/room/{room_id}', [ESPController::class, 'changeDeviceStatus']);
Route::post('user/{user_id}/room/{room_id}/devices', [ESPController::class, 'changeDeviceAllStatus']);

//----------------------------------------------------------------------------------------------------------------------------


include __DIR__ . '/adminApi.php';
