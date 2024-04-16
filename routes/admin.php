<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\TypeController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){


    Route::get('login',[AuthController::class,'create'])->name('login');
    Route::post('login',[AuthController::class,'store']);

    Route::resource('types',TypeController::class);

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/', [AdminController::class,'index'])->name('admin');
        Route::resource('types',TypeController::class)->names('admin.types');
        Route::resource('users',UserController::class)->names('admin.users');

    });


});
