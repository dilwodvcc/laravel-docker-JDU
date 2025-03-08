<?php

use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\GroupStudentController;
use App\Http\Controllers\Api\GroupSubjectController;
use App\Http\Controllers\Api\RoleUserController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SubjectTeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('logout', [AuthController::class, 'logout']);

    // Subjects Routes
    Route::resource('subjects', SubjectController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('schedules', ScheduleController::class);


    Route::resource('role-user',RoleUserController::class);
    Route::resource('group-subjects', GroupSubjectController::class);
    Route::resource('group-students', GroupStudentController::class);
    Route::resource('subject-teachers', SubjectTeacherController::class);

});
