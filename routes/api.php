<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//API ROUTE
Route::post('/tasks/store', 'App\Http\Controllers\TaskController@store');
Route::get('/tasks','App\Http\Controllers\TaskController@index');
//DELETE
Route::post('/tasks/destroy/{id}','App\Http\Controllers\TaskController@destroy');
