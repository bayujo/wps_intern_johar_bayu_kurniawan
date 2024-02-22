<?php

use App\Http\Controllers\DailyLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/users', [UserController::class, 'index'])->name('user');
    Route::post('/users/table', [UserController::class, 'table']);

    Route::post('/users/add', [UserController::class, 'add']);
    Route::post('/users/update', [UserController::class, 'update']);
    Route::post('/users/{id}', [UserController::class, 'delete']);

    Route::get('/logs', [DailyLogController::class, 'index'])->name('log');
    Route::post('/logs/table', [DailyLogController::class, 'table']);

    Route::get('/self', [DailyLogController::class, 'self'])->name('self');
    Route::post('/logs/add', [DailyLogController::class, 'add'])->name('daily_logs.add');
    Route::post('/logs/update', [DailyLogController::class, 'update'])->name('daily_logs.update');
    Route::post('/logs/{id}', [DailyLogController::class, 'delete']);

    Route::get('/get-events', [DailyLogController::class, 'getEventsForFullCalendar'])->name('get-events');
});
