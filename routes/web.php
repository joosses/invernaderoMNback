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
Route::post('/usuario/login','UserController@login');
Route::put('/user/update','UserController@update');
Route::post('/user/upload','UserController@upload')->middleware(ApiAuthMiddleware::class);
Route::get('/user/image/{filename}','UserController@getImage');
Route::put('/userDisable/{id}','UserController@disable');
Route::delete('/user/{id}','UserController@destroy');

Route::put('/actuadoru/{id}','ActuadorController@update');
Route::put('/actuadorreset/{id}','ActuadorController@resetTiempo');
Route::get('/actuador','ActuadorController@index');
Route::get('/actuadorB/{id}','ActuadorController@show');
Route::get('/actuadorluz','ActuadorController@showLuz');
Route::get('/actuadoragua','ActuadorController@showAgua');
Route::get('/actuadorextractor','ActuadorController@showExtractor');






Route::get('/marcas','autoController@index');
Route::get('/medicion','MedicionController@index');
Route::post('/medicion/temp','MedicionController@medicionTemperatura');
Route::post('/medicion/prueba','MedicionController@prueba');
Route::post('/medicion/hum','MedicionController@medicionHumedad');
Route::post('/medicion/suel','MedicionController@medicionSuelo');
Route::post('/medicion/co2','MedicionController@medicionCo2');

Route::get('/medicionHumedad','MedicionController@ultimaHumedad');
Route::get('/grafica','MedicionController@grafica');
Route::get('/medicionTemperatura','MedicionController@ultimaTemperatura');
Route::get('/medicionHumedadSuelo','MedicionController@ultimaHumedadSuelo');
Route::get('/medicionCo2','MedicionController@ultimaCo2');

Route::get('/sensor/{id}','SensorController@show');
Route::get('/temperaturamin','SensorController@showTemperaturaMin');
Route::get('/humedadmin','SensorController@showHumedadMin');
Route::get('/humedadsuelomin','SensorController@showHumedadSueloMin');
Route::get('/co2min','SensorController@showCo2Min');
Route::put('/sensoru/{id}','SensorController@update');
Route::post('/sensor/nuevo','SensorController@nuevo');

Route::get('/invernadero/{id}','InvernaderoController@show');
Route::get('/invernadero','InvernaderoController@index');
Route::put('/invernaderou/{id}','InvernaderoController@update');
Route::post('/invernadero/inv','InvernaderoController@crear');
Route::post('/invernadero/nuevo','InvernaderoController@nuevo');


Route::post('/medicion/crear2','MedicionController@prueba');
Route::get('/', function () {
    return view('welcome');
});
