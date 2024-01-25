<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'renderHome'])->name('homeView');
Route::get('/register', [RegisterController::class, 'registerView'])->name('registerView');
Route::get('/login', [AuthController::class, 'renderLogin'])->name('loginView');
Route::get('/requests', [RequestsController::class, 'get'])->name('requestsView');