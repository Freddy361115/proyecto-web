<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    
});

Route::resource('profesores','App\Http\Controllers\ProfesorController');
Route::resource('supervisors','App\Http\Controllers\SupervisorController');
Route::resource('establecimientos','App\Http\Controllers\EstablecimientoController');
Route::resource('grados','App\Http\Controllers\GradoController');
Route::resource('roles','App\Http\Controllers\RoleController');
Route::resource('tiponotificacion','App\Http\Controllers\TipoNotificacionController');
Route::resource('notificacion','App\Http\Controllers\NotificacionController');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signUp');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth:api');

    });
});

