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

Route::group(['middleware' => ['api','jwt.verify']], function ($router) {
    
    Route::group(['prefix' => 'category'],function(){

        Route::get('/option','CategoriesController@getAll')->name('category-option');
        Route::post('/', 'CategoriesController@create')->name('create-category');
        Route::get('/', 'CategoriesController@index')->name('display-categories');

    });
    
    Route::group( ['prefix' => 'product'], function(){

        Route::post('/', 'ProductsController@create')->name('create-product');
        Route::get('/', 'ProductsController@index')->name('display-products');
        Route::delete('/{pid}', 'ProductsController@destroy')->name('delete-products');
        Route::post('/photo', 'ProductsController@uploadPhoto')->name('upload-product-photo');
        Route::put('/{id}/photo', 'ProductsController@setProductPhoto')->name('set-product-photo');

    });

    
});