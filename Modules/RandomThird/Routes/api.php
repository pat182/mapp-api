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

Route::group(['middleware' => ['api','jwt.verify'], "prefix" => 'random'], function ($router) {
    
    Route::GET('','RandomThirdController@index');
    Route::POST('convert', 'RandomThirdController@convertCurrencies');

});