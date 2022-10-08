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

Route::post('login', 'App\Http\Controllers\UserController@login');
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::get('details/{user}', 'App\Http\Controllers\UserController@details');

//Route::get('notifiacion/{user}/getNotificationbyUser', 'App\Http\Controllers\NotificacionController@getNotificationsbyUser');


Route::resource('profesores','App\Http\Controllers\ProfesorController');
Route::resource('supervisors','App\Http\Controllers\SupervisorController');
Route::resource('establecimientos','App\Http\Controllers\EstablecimientoController');
Route::resource('grados','App\Http\Controllers\GradoController');
Route::resource('roles','App\Http\Controllers\RoleController');
Route::resource('tiponotificacion','App\Http\Controllers\TipoNotificacionController');
Route::resource('notificacion','App\Http\Controllers\NotificacionController');
Route::get('misnotificaciones/{id}','App\Http\Controllers\NotificacionController@misnotificaciones');
Route::get('misnotificacionesleidas/{id}','App\Http\Controllers\NotificacionController@misnotificacionesleidas');
Route::get('misnotificacionesnoleidas/{id}','App\Http\Controllers\NotificacionController@misnotificacionesnoleidas');

/*
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'App\Http\Controllers\UserController@details');
Route::resource('profesores','App\Http\Controllers\ProfesorController');
Route::resource('supervisors','App\Http\Controllers\SupervisorController');
Route::resource('establecimientos','App\Http\Controllers\EstablecimientoController');
Route::resource('grados','App\Http\Controllers\GradoController');
Route::resource('roles','App\Http\Controllers\RoleController');
Route::resource('tiponotificacion','App\Http\Controllers\TipoNotificacionController');
Route::resource('notificacion','App\Http\Controllers\NotificacionController');
});
*/
