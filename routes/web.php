<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\TaskController; 
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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>['web']],function(){

    Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index']);
    Route::post('/task', [App\Http\Controllers\TaskController::class,'store']);
    Route::get('/task/edit/{id}', [App\Http\Controllers\TaskController::class,'edit']);
    Route::post('/task/update/{id}', [App\Http\Controllers\TaskController::class,'update']);
    Route::delete('/task/{id}', [App\Http\Controllers\TaskController::class,'destroy']);
    Route::get('/search', [App\Http\Controllers\TaskController::class,'search']);
    Route::auth();
});