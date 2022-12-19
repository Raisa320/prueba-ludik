<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\controllers\AuthController;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']); //READ USER LOGIN
    Route::post('createdUser',[AuthController::class, 'createdUser']); //CREATE USER

});


Route::get('/users','App\Http\Controllers\UserController@index'); //LIST USERS
Route::get('/users/{id}','App\Http\Controllers\UserController@show'); //READ USER
Route::put('/users/{id}','App\Http\Controllers\UserController@update'); //UPDATE USER
Route::delete('/users/{id}','App\Http\Controllers\UserController@destroy'); 
Route::post('/porcentajeCreacion','App\Http\Controllers\UserController@usuariosRegistradosFecha'); //LIST USERS

Route::get('/codes','App\Http\Controllers\CodeController@index'); //LIST CODES
Route::get('/codes/{id}','App\Http\Controllers\CodeController@show'); //READ CODES
Route::post('/codes','App\Http\Controllers\CodeController@store'); //CREATED CODES
Route::delete('/codes/{id}','App\Http\Controllers\CodeController@destroy'); //DELETED CODES
Route::put('/codes/{id}','App\Http\Controllers\CodeController@update'); //UDPDATED
Route::get('/mayorCantidadCodigos','App\Http\Controllers\CodeController@mayorCantidadCodigos'); //MAYOR CODIGOS