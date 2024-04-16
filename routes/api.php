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

Route::middleware('auth:user')->get('/user', function (Request $request) {
    return $request->user();
});

//-----------------------mobile API-----------------------------------------------------------------------------------------------------

Route::group(['middleware'=>'guest'],function(){

    Route::post('register', [AuthApiController::class, 'register']);
    Route::post('login', [AuthApiController::class, 'login']);
});

Route::middleware('auth:user')->group(function () {

    Route::resource('rooms', RoomController::class);
    Route::resource('room/{id}/devices', DeviceController::class)->only(['index','store']);
    Route::resource('devices', DeviceController::class)->except(['index','store']);
    Route::get('all-devices', [DeviceController::class, 'getAllDevices']);
    Route::get('types', [TypeController::class, 'index']);
    Route::get('types/devices', [TypeController::class, 'getDeviceTypes']);


});


//---------------------- ESP Integration ------------------------------------------------------------------------------------------------------

Route::get('user/{user_id}/room/{room_id}', [ESPController::class, 'getAllDeviceInRoom']);
Route::post('user/{user_id}/room/{room_id}', [ESPController::class, 'changeDeviceStatus']);
Route::post('user/{user_id}/room/{room_id}/devices', [ESPController::class, 'changeDeviceAllStatus']);

//----------------------------------------------------------------------------------------------------------------------------


