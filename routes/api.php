<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Matches\MatchController;
use App\Http\Controllers\Player\PlayerController;
use App\Http\Controllers\Teams\TeamController;
use App\Http\Controllers\User\UserController;
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

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('authJwt')->group(function () {

    Route::prefix('player')->group(function () {
        Route::post('/', [PlayerController::class, 'create']);
        Route::put('/{id}', [PlayerController::class, 'update']);
    });

    Route::prefix('user')->group(function () {
        Route::post('/', [UserController::class, 'create']);
    });

    Route::prefix('team')->group(function () {
        Route::patch('/{id}', [TeamController::class, 'edit']);
        Route::post('/', [TeamController::class, 'create']);
        Route::get('/', [TeamController::class, 'list']);
    });

    Route::prefix('match')->group(function () {
        Route::post('/', [MatchController::class, 'create']);
    });
});
