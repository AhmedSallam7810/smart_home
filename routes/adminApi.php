<?php

use App\Http\Controllers\Api\admin\AuthApiController;
use App\Http\Controllers\Api\admin\TypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){

    Route::post('test',function(){
        return "teeest";
    });
    Route::post('login',[AuthApiController::class,'login']);
    Route::resource('types',TypeController::class);

    Route::middleware('auth:admin')->group(function(){
    });


});