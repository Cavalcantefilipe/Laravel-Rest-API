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

Route::get('marcas', 'Marca\MarcaController@getMarcas');
Route::get('marca/{id}', 'Marca\MarcaController@getMarca');
Route::post('marca', 'Marca\MarcaController@createMarca');
Route::put('marca/{id}', 'Marca\MarcaController@updateMarca');
Route::delete('marca/{id}', 'Marca\MarcaController@deleteMarca');

Route::get('carros', 'Carro\CarroController@getCarros');
Route::get('carro/{id}', 'Carro\CarroController@getCarro');
Route::post('carro', 'Carro\CarroController@createCarro');
Route::put('carro/{id}', 'Carro\CarroController@updateCarro');
Route::delete('carro/{id}', 'Carro\CarroController@deleteCarro');
