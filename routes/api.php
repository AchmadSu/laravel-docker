<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(UserController::class)->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('users', 'index');
        Route::put('users', 'updateUser');
    });
    Route::post('register', 'addUser');
    Route::post('auth', 'login');
});

Route::controller(BookController::class)->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('books', 'index');
        Route::post('books', 'create');
    });
});

Route::controller(ModuleController::class)->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('modules', 'index');
        Route::post('modules', 'create');
        Route::put('modules', 'update');
        Route::delete('modules', 'destroy');
    });
});

Route::controller(LessonController::class)->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('lesson', 'index');
        Route::post('lesson', 'create');
        Route::put('lesson', 'update');
        Route::delete('lesson', 'destroy');
    });
});
