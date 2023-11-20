<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AlertsController;
use App\Http\Controllers\DciController;
use App\Http\Controllers\SourcesController;

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

Route::resource('categories', CategoriesController::class);
Route::resource('dci', DciController::class);
Route::resource('sources', SourcesController::class);
Route::resource('alert', AlertsController::class);