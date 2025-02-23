<?php

use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\AuthController;
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
    Route::prefix('subjects')->group(function () {
        Route::get('/', [SubjectController::class, 'index']);
        Route::get('/{subject}', [SubjectController::class, 'show']);
        Route::post('/', [SubjectController::class, 'store']);
        Route::put('/{subject}', [SubjectController::class, 'update']);
        Route::delete('/{subject}', [SubjectController::class, 'destroy']);
    });

    Route::prefix('groups')->group(function () {
        Route::get('/', [GroupController::class, 'index']);
        Route::get('/{group}', [GroupController::class, 'show']);
        Route::post('/', [GroupController::class, 'store']);
        Route::put('/{group}', [GroupController::class, 'update']);
        Route::delete('/{group}', [GroupController::class, 'destroy']);
    });

    Route::prefix('rooms')->group(function () {
        Route::get('/', [RoomController::class, 'index']);
        Route::get('/{room}', [RoomController::class, 'show']);
        Route::post('/', [RoomController::class, 'store']);
        Route::put('/{room}', [RoomController::class, 'update']);
        Route::delete('/{room}', [RoomController::class, 'destroy']);
    });
});
