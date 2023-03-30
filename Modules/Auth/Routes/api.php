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
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

// Route::group(['middleware' => ['api','jwt.verify']], function ($router) {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     // Route::post('/refresh', [AuthController::class, 'refresh']);
// });
// Route::middleware('auth:api')->get('/auth', function (Request $request) {
//     return $request->user();
// });