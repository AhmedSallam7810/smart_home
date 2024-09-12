<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\user\DeviceController;
use App\Http\Controllers\Api\user\RoomController;
use App\Http\Controllers\Api\user\TypeController;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\user\ESPController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;



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
    Route::get('email/verify/{id}', [AuthApiController::class,'verify_email'])->name('verification.verify'); // Make sure to keep this as your route name
    Route::post('login', [AuthApiController::class, 'login']);
    Route::post('/forgot-password', [AuthApiController::class,'forget_password'])->name('password.email');

});

//------------------------------------------------------------------------------------------------------------------------------------------


Route::middleware('auth:user')->group(function () {

    Route::post('rooms/config/{id}', [RoomController::class, 'config']);
    Route::resource('rooms', RoomController::class);
    Route::resource('room/{id}/devices', DeviceController::class)->only(['index','store']);
    Route::resource('devices', DeviceController::class)->except(['index','store']);//add destroy to except
    Route::put('timer/{id}/{minutes}', [DeviceController::class, 'timer']);
    Route::get('all-devices', [DeviceController::class, 'getAllDevices']);
    Route::get('types', [TypeController::class, 'index']);
    Route::get('types/devices', [TypeController::class, 'getDeviceTypes']);
    Route::delete('account', [AuthApiController::class, 'deleteAccount']);

});


//---------------------- ESP Integration ------------------------------------------------------------------------------------------------------

Route::get('user/{user_id}/room/{room_id}', [ESPController::class, 'getAllDeviceInRoom']);
Route::post('user/{user_id}/room/{room_id}', [ESPController::class, 'changeDeviceStatus']);
Route::post('user/{user_id}/room/{room_id}/devices', [ESPController::class, 'changeDeviceAllStatus']);

//----------------------------------------------------------------------------------------------------------------------------


