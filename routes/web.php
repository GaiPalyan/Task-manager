<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatusController;
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

Route::get('/', function () {
    return view('welcome');
})->name('main');

Auth::routes(['verify' => true]);
Route::get('/home', [HomeController::class, 'index'])->middleware('verified')
    ->name('home');
Route::get('task_statuses', [StatusController::class, 'index'])
    ->name('task_statuses');
Route::get('task_statuses/create', [StatusController::class, 'create'])->name('status_create');
Route::get('task_statuses/{id}/edit', [StatusController::class, 'edit'])->name('status_edit');
Route::patch('task_statuses/{id}', [StatusController::class, 'update'])->name('status_update');
Route::post('task_statuses', [StatusController::class, 'store'])->name('status_store');

