<?php

use App\Http\Controllers\Api\Teacher\CurriculumController;
use App\Http\Controllers\Api\Vacancy\VacancyController;
use Illuminate\Support\Facades\Route;




Route::prefix('/vacancy')->group(function () {

    Route::get('/', [VacancyController::class, 'index']);
    Route::middleware('auth:sanctum,teacher')->get('/{public_id}/{slug}', [VacancyController::class, 'show']);


    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::post('/', [VacancyController::class, 'store']);
        Route::get('/adminVacancies', [VacancyController::class, 'adminIndex']);
        Route::delete('/{public_id}', [VacancyController::class, 'destroy']);
        Route::patch('/{public_id}', [VacancyController::class, 'update']);
    });


});

Route::prefix('/curriculum')->group(function () {
    Route::post(
        '/vacancies/{vacancy}/',
        [CurriculumController::class, 'store']
    )->middleware('auth:sanctum');

    Route::middleware(['auth:sanctum', 'role:admin'])
        ->get('/vacancies/{slug_vacancy}',
            [CurriculumController::class, 'indexByVacancy']);

    Route::middleware(['auth:sanctum', 'role:admin'])
        ->get('/{public_id}',
        [CurriculumController::class, 'show']);




});






