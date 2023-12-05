<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AlertsController;
use App\Http\Controllers\DciController;
use App\Http\Controllers\SourcesController;
use App\Http\Controllers\AuthController;

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

Route::post('/importSource',[SourcesController::class,'ImportData']);
Route::post('/importDci',[DciController::class,'ImportData']);
//http://127.0.0.1:8000/api/alertsysteme
Route::post('/alert-system',[AlertsController::class,'AlertSystem']);
Route::post('/alertsysteme',[AlertsController::class,'AllData']);
// Route::get('/getapi',[AlertsController::class,'getApi']);
    

// Route::get('/login', [AuthController::class],'login')->name('login');
// Route::get('/logout',[AuthController::class],'logout')->name('logout');
// Route::get('/auth0/callback', [AuthController::class],'callback')->name('auth0-callback');
