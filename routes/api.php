<?php

use App\Http\Controllers\Api\Auth\LoginAdminController;
use App\Http\Controllers\Api\Auth\LoginStudentController;
use App\Http\Controllers\Api\Auth\LoginTeacherController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterAdminController;
use App\Http\Controllers\Api\Auth\RegisterTeacherController;
use App\Http\Controllers\Api\Vacancy\VacancyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterStudentController;

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

Route::prefix('/vacancy')->group(function () {
    Route::post('/', [VacancyController::class, 'store'])->middleware(['auth:sanctum', 'role:admin']);
    Route::get('/', [VacancyController::class, 'index']);
    Route::get('/adminVacancies', [VacancyController::class, 'adminIndex'])
        ->middleware(['auth:sanctum', 'role:admin']);
    Route::get('/{slug_vacancy}/{public_id}', [VacancyController::class, 'show'])
        ->middleware('auth:sanctum');

    Route::delete('/{public_id}', [VacancyController::class, 'destroy'])->middleware(['auth:sanctum', 'role:admin']);
});



