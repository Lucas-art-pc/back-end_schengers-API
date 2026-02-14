<?php

use App\Http\Controllers\Api\Auth\LoginAdminController;
use App\Http\Controllers\Api\Auth\LoginStudentController;
use App\Http\Controllers\Api\Auth\LoginTeacherController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterAdminController;
use App\Http\Controllers\Api\Auth\RegisterStudentController;
use App\Http\Controllers\Api\Auth\RegisterTeacherController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {

    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');

    Route::prefix('/user')->group(function () {
        Route::post('/', RegisterStudentController::class);
        Route::post('/login', LoginStudentController::class);
    });


    Route::prefix('/teacher')->group(function () {
        Route::post('/', RegisterTeacherController::class);
        Route::post('/login', LoginTeacherController::class);
    });

    Route::prefix('admin')->group(function () {
        Route::post('/login', LoginAdminController::class);

        Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
            Route::post('/', RegisterAdminController::class);
        });
    });

});
