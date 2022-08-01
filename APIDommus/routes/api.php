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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', 'App\Http\Controllers\Api\AuthController@login');
Route::post('usuario', 'App\Http\Controllers\Api\UserController@store');

Route::group(['middleware' => ['apiJWT']], function(){
    Route::get('users', 'App\Http\Controllers\Api\UserController@index');
    Route::post('logout', 'App\Http\Controllers\Api\AuthController@logout');
    Route::get('empreendimentos', 'App\Http\Controllers\EmpreendimentoController@getEmpreendimentos');
	Route::get('empreendimentos/{id}', 'App\Http\Controllers\EmpreendimentoController@getEmpreendimento');
    Route::post('empreendimentos', 'App\Http\Controllers\EmpreendimentoController@create');
    Route::put('empreendimentos/{id}', 'App\Http\Controllers\EmpreendimentoController@update');
    Route::delete('empreendimentos/{id}', 'App\Http\Controllers\EmpreendimentoController@delete');
    Route::get('unidades', 'App\Http\Controllers\UnidadeController@getUnidades');
    Route::post('unidades', 'App\Http\Controllers\UnidadeController@create');
    Route::put('unidades/{id}', 'App\Http\Controllers\UnidadeController@update');
    Route::delete('unidades/{id}', 'App\Http\Controllers\UnidadeController@delete');
    Route::post('unidadesAutomatico', 'App\Http\Controllers\UnidadeController@cadastroUnidades');
    Route::post('reajustarValor', 'App\Http\Controllers\UnidadeController@reajustarValor');
});