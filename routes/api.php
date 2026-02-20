<?php

use App\Http\Controllers\Api\Course\CourseController;
use App\Http\Controllers\Api\Teacher\ActionCurriculumController;
use App\Http\Controllers\Api\Teacher\CurriculumController;
use App\Http\Controllers\Api\Vacancy\VacancyController;
use Illuminate\Support\Facades\Route;




Route::prefix('/vacancy')->group(function () {

    Route::get('/', [VacancyController::class, 'index']);
    Route::get('/{public_id}/{slug}', [VacancyController::class, 'show']);



        Route::post('/', [VacancyController::class, 'store']);
        Route::get('/adminVacancies', [VacancyController::class, 'adminIndex']);
        Route::delete('/{public_id}', [VacancyController::class, 'destroy']);
        Route::patch('/{public_id}', [VacancyController::class, 'update']);


});

Route::prefix('/curriculum')->group(function () {
    Route::post(
        '/vacancies/{vacancy}/',
        [CurriculumController::class, 'store']
    );

    Route::get('/vacancies/{slug_vacancy}',
            [CurriculumController::class, 'indexByVacancy']);

    Route::middleware(['auth:sanctum', 'role:admin'])
        ->get('/{public_id}',
        [CurriculumController::class, 'show']);

    Route::patch('/{curriculum}/approve',
        [ActionCurriculumController::class, 'approveCurriculum']
    );

    Route::patch('/{curriculum}/reject',
        [ActionCurriculumController::class, 'rejectCurriculum']
    );

});


Route::prefix('course')->group(function () {
    Route::post('/', [CourseController::class, 'store']);
    Route::get('/', [CourseController::class, 'index']);
    Route::delete('/{public_id}', [CourseController::class, 'destroy']);
});






