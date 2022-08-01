<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/empreendimentos', 'App\Http\Controllers\EmpreendimentoController@getEmpreendimentos');
Route::post('/empreendimentos/novo', 'App\Http\Controllers\EmpreendimentoController@create');
Route::get('empreendimentos/{id}', 'App\Http\Controllers\EmpreendimentoController@getEmpreendimento');
Route::put('empreendimentos/{id}', 'App\Http\Controllers\EmpreendimentoController@update');
Route::delete('empreendimentos/{id}', 'App\Http\Controllers\EmpreendimentoController@delete');
Route::get('unidades', 'App\Http\Controllers\UnidadeController@getUnidades');
Route::get('unidades/{id}', 'App\Http\Controllers\UnidadeController@getUnidade');
Route::post('unidades', 'App\Http\Controllers\UnidadeController@create');
Route::put('unidades/{id}', 'App\Http\Controllers\UnidadeController@update');
Route::delete('unidades/{id}', 'App\Http\Controllers\UnidadeController@delete');
Route::post('unidadesAutomatico', 'App\Http\Controllers\UnidadeController@cadastroUnidades');
Route::post('reajustarValor', 'App\Http\Controllers\UnidadeController@reajustarValor');