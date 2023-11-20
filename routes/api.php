<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AlertsController;
use App\Http\Controllers\DciController;
use App\Http\Controllers\SourcesController;

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



Route::resource('categories', CategoriesController::class);
Route::resource('dci', DciController::class);
Route::resource('sources', SourcesController::class);
Route::resource('alert', AlertsController::class);