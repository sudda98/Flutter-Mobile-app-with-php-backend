<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;

Route::prefix('api/v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/courses', [CourseController::class, 'index']);
        Route::get('/courses/{course}', [CourseController::class, 'show']);
        Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll']);
        Route::delete('/courses/{course}/unenroll', [CourseController::class, 'unenroll']);

        Route::middleware('role:instructor')->group(function () {
            Route::post('/courses', [CourseController::class, 'store']);
            Route::put('/courses/{course}', [CourseController::class, 'update']);
            Route::delete('/courses/{course}', [CourseController::class, 'destroy']);
        });
    });

    Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
        Route::post('/enrollments', [EnrollmentController::class, 'store']);
        Route::delete('/enrollments/{enrollment}', [EnrollmentController::class, 'destroy']);
    });
});
