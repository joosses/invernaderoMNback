<?php

use Illuminate\Http\Request;

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
Route::post('/', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Storage::append("node-log.txt",
        "valor: " . $request->get("valor", "n/a") .
        "tiempo: " . now()->format("Y-m-d H:i:s")  
    );
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
