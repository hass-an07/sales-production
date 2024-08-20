<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentTwoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\WorkerController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/login', [AuthenticateController::class, 'login'])->name('account.login');
Route::post('/login', [AuthenticateController::class, 'authenticate'])->name('account.authenticate');
Route::get('/register', [AuthenticateController::class, 'register'])->name('account.register');
Route::post('/process-register', [AuthenticateController::class, 'processregister'])->name('account.processregister');

Route::middleware(AuthMiddleware::class)->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });


    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/company', CompanyController::class);
    Route::resource('/department', DepartmentController::class);
    Route::resource('/department2', DepartmentTwoController::class);
    Route::resource('/worker', WorkerController::class);
    Route::resource('/materialType', MaterialTypeController::class);
    Route::resource('/material', MaterialController::class);
    Route::get('/logout', [AuthenticateController::class, 'logout'])->name('account.logout');
});
