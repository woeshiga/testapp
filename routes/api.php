<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\RequestsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogOutController;

Route::group(['middleware' => ['web']], function () {
    Route::get('/requests', [RequestsController::class, 'get']);
    Route::post('/requests', [RequestsController::class, 'create'])->name("requestForm");
    Route::put('/requests/{id}', [RequestsController::class, 'resolve'])->name("resolve");
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [LogOutController::class, 'logout'])->name('logout');
});

