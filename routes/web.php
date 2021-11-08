<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('main');

/**
 * Authenticate & authorization routs group
 */
Auth::routes();

/**
 * Statuses routs group
 */
Route::resource('statuses', StatusController::class);

/**
 * Tasks routs group
 */
Route::resource('tasks', TaskController::class);

/**
 * Label routs group
 */
Route::resource('labels', LabelController::class);
