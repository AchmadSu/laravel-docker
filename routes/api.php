<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
