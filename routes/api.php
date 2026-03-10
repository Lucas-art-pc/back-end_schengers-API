<?php

use App\Http\Controllers\Api\Admin\DataStudents;
use App\Http\Controllers\Api\Admin\DataTeachers;
use App\Http\Controllers\Api\Auth\LoginAdminController;
use App\Http\Controllers\Api\Auth\LoginStudentController;
use App\Http\Controllers\Api\Auth\LoginTeacherAuthorizedController;
use App\Http\Controllers\Api\Auth\LoginTeacherController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterAdminController;
use App\Http\Controllers\Api\Auth\RegisterStudentController;
use App\Http\Controllers\Api\Auth\RegisterTeacherController;
use App\Http\Controllers\Api\Course\ActivityCourse\ActivityCourseController;
use App\Http\Controllers\Api\Course\ActivityCourse\AnswersCourseController;
use App\Http\Controllers\Api\Course\ClassCourse\ClassCourseController;
use App\Http\Controllers\Api\Course\CourseController;
use App\Http\Controllers\Api\Enrollment\EnrollmentController;
use App\Http\Controllers\Api\MercadoPago\UpgradeOrder;
use App\Http\Controllers\Api\Teacher\ActionCurriculumController;
use App\Http\Controllers\Api\Teacher\CurriculumController;
use App\Http\Controllers\Api\Vacancy\VacancyController;
use Illuminate\Http\Request;
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
        Route::post('/loginTeacherAuthorized', LoginTeacherAuthorizedController::class);
    });

    Route::prefix('admin')->group(function () {
        Route::post('/login', LoginAdminController::class);

        Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
            Route::post('/', RegisterAdminController::class);
        });
    });

});

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


Route::prefix('courses')->group(function () {

    Route::get('/activities/{public_id_activity}/answer', [AnswersCourseController::class, 'getAnswer'])->middleware('auth:sanctum');
    Route::post('/activities/answer', [AnswersCourseController::class, 'answer'])->middleware('auth:sanctum');

    Route::get('/coursesPerStudent', [EnrollmentController::class, 'coursesPerStudent'])->middleware('auth:sanctum');
    Route::middleware('auth:sanctum')->post('/{public_id_course}/enroll', [EnrollmentController::class, 'enroll']);

    Route::post('/', [CourseController::class, 'store']);
    Route::get('/', [CourseController::class, 'index']);
    Route::get('/admin', [CourseController::class, 'teacherCourses']);

    Route::get('/{public_id}', [CourseController::class, 'show']);
    Route::delete('/{public_id}', [CourseController::class, 'destroy']);
    Route::patch('/{public_id}', [CourseController::class, 'update']);

    Route::get('/{public_id}/classes', [ClassCourseController::class, 'index']);
    Route::get('/{public_id}/classes/{public_id_class}', [ClassCourseController::class, 'show']);
    Route::post('/{public_id}/classes', [ClassCourseController::class, 'store']);
    Route::patch('/{public_id}/classes/{public_id_class}', [ClassCourseController::class, 'update']);
    Route::delete('/{public_id}/classes/{public_id_class}', [ClassCourseController::class, 'destroy']);

    Route::get('/{public_id}/activities', [ActivityCourseController::class, 'index']);
    Route::post('/{public_id}/activities', [ActivityCourseController::class, 'store']);
    Route::get('/{public_id}/activities/{public_id_activity}', [ActivityCourseController::class, 'show']);
    Route::patch('/{public_id}/activities/{public_id_activity}', [ActivityCourseController::class, 'update']);
    Route::delete('/{public_id}/activities/{public_id_activity}', [ActivityCourseController::class, 'destroy']);

});

Route::prefix('admin')->group(function () {
    Route::get('/countStudents', [DataStudents::class, 'countStudents']);
    Route::get('/listStudents', [DataStudents::class, 'indexStudents']);

    Route::get('/countTeachers', [DataTeachers::class, 'countTeachers']);
    Route::get('/listTeachers', [DataTeachers::class, 'indexTeachers']);
});







