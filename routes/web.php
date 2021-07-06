<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PubsController;

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
Route::resource('/pubs', PubsController::class);

Route::get('/pubs/up/{pub}', \App\Http\Controllers\PubsController::class, 'up');

Route::get('/pubs/down/{pub}', \App\Http\Controllers\HomeController::class, 'down');

Auth::routes();

Route::get('/home', redirect('/'));

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');