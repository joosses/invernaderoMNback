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
//RUTAS PARA 
//use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/usuario','UsuarioController@index');
Route::get('/usuario/{id}','UsuarioController@show');
Route::post('/usuario/crear','UsuarioController@register');
Route::post('/usuario/login','UsuarioController@login');
Route::put('/usuario/update','UsuarioController@update');
Route::post('/usuario/upload','UsuarioController@upload')->middleware(ApiAuthMiddleware::class);
Route::get('/usuario/image/{filename}','UsuarioController@getImage');
Route::put('/userDisable/{id}','UsuarioController@disable');
Route::delete('/usuario/{id}','UsuarioController@destroy');
Route::get('/usuarioBuscar','UsuarioController@lista');
Route::put('/usuariou/{id}','UsuarioController@update2');


Route::put('/actuadoru/{id}','ActuadorController@update');
Route::put('/actuadorreset/{id}','ActuadorController@resetTiempo');
Route::get('/actuador','ActuadorController@index');
Route::get('/actuadorB/{id}','ActuadorController@show');
Route::get('/actuadorluz/{id}','ActuadorController@showLuz');
Route::get('/actuadoragua/{id}','ActuadorController@showAgua');
Route::get('/actuadorextractor/{id}','ActuadorController@showExtractor');
Route::get('/actuadorextractor2/{id}','ActuadorController@showExtractor2');
Route::post('/actuador/registrar','ActuadorController@register');

Route::get('/marcas','autoController@index');
Route::get('/medicion','MedicionController@index');
Route::get('/medicion/{id}','MedicionController@show');
Route::post('/medicion/temp','MedicionController@medicionTemperatura');
Route::post('/medicion/prueba','MedicionController@prueba');
Route::post('/medicion/hum','MedicionController@medicionHumedad');
Route::post('/medicion/suel','MedicionController@medicionSuelo');
Route::post('/medicion/co2','MedicionController@medicionCo2');

Route::get('/medicionhumedad/{id}','MedicionController@ultimaHumedad');
Route::get('/grafica','MedicionController@grafica');
Route::get('/graficat/{id}','MedicionController@graficaTemperatura');
Route::get('/graficah/{id}','MedicionController@graficaHumedad');
Route::get('/graficahs/{id}','MedicionController@graficaHumedadSuelo');
Route::get('/graficac/{id}','MedicionController@graficaCo2');
Route::get('/mediciontemperatura/{id}','MedicionController@ultimaTemperatura');
Route::get('/medicionhumedadsuelo/{id}','MedicionController@ultimaHumedadSuelo');
Route::get('/medicionco2/{id}','MedicionController@ultimaCo2');



Route::get('/sensor/{id}','SensorController@show');
Route::get('/sensorBuscar/{id}','SensorController@lista');
Route::get('/temperaturamin/{id}','SensorController@showTemperaturaMin');
Route::get('/humedadmin/{id}','SensorController@showHumedadMin');
Route::get('/humedadsuelomin/{id}','SensorController@showHumedadSueloMin');
Route::get('/co2min/{id}','SensorController@showCo2Min');
Route::put('/sensoru/{id}','SensorController@update');
Route::post('/sensor/nuevo','SensorController@nuevo');
Route::post('/sensor/registrar','SensorController@register');

Route::get('/invernadero/{id}','InvernaderoController@show');

Route::get('/invernaderonombre/{id}','InvernaderoController@buscarNombre');
Route::get('/invernaderob/{id}','InvernaderoController@buscar');
Route::get('/invernabusca/{id}','InvernaderoController@buscarDos');
Route::get('/invernadero','InvernaderoController@index');
Route::put('/invernaderou/{id}','InvernaderoController@update');
Route::post('/inverna/crear','InvernaderoController@crear');
Route::post('/invernadero/crear','InvernaderoController@register');
Route::post('/invernaderon/nuevo','InvernaderoController@nuevo');
Route::get('/invernaderoBuscar','InvernaderoController@lista');
Route::get('/tabla','InvernaderoController@tabla');


Route::post('/medicion/crear2','MedicionController@prueba');
Route::get('/', function () {
    return view('welcome');
});
