<?php

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
//RUTAS PARA USUARIO
Route::get('/usuario','UsuarioController@index');
Route::get('/usuario/{id}','UsuarioController@show');
Route::post('/usuario/crear','UsuarioController@register');
Route::post('/user/login','UserController@login');
Route::put('/user/update','UserController@update');
Route::post('/user/upload','UserController@upload')->middleware(ApiAuthMiddleware::class);
Route::get('/user/image/{filename}','UserController@getImage');
Route::put('/userDisable/{id}','UserController@disable');
Route::delete('/user/{id}','UserController@destroy');

Route::put('/actuador/{id}','ActuadorController@update');
Route::get('/actuador','ActuadorController@index');
Route::get('/actuadorB/{id}','ActuadorController@show');

Route::get('/sensor/{id}','SensorController@show');


Route::get('/marcas','autoController@index');
Route::get('/medicion','MedicionController@index');
Route::post('/medicion/temp','MedicionController@medicionTemperatura');
Route::post('/medicion/prueba','MedicionController@prueba');
Route::post('/medicion/hum','MedicionController@medicionHumedad');
Route::post('/medicion/suel','MedicionController@medicionSuelo');
Route::post('/medicion/co2','MedicionController@medicionCo2');

Route::get('/medicionHumedad','MedicionController@ultimaHumedad');
Route::get('/medicionTemperatura','MedicionController@ultimaTemperatura');
Route::get('/medicionHumedadSuelo','MedicionController@ultimaHumedadSuelo');
Route::get('/medicionCo2','MedicionController@ultimaCo2');

Route::get('/temperaturamin','SensorController@showTemperaturaMin');
Route::get('/humedadmin','SensorController@showHumedadMin');
Route::get('/humedadsuelomin','SensorController@showHumedadSueloMin');
Route::get('/co2min','SensorController@showCo2Min');


Route::post('/medicion/crear2','MedicionController@prueba');
Route::get('/', function () {
    return view('welcome');
});
