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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/workers', 'Api\ApiWorkers@index');
Route::get('/workers/edit/{any}', 'Api\ApiWorkers@edit');
Route::post('/workers/edit/{any}', 'Api\ApiWorkers@save');
Route::post('/workers/delete/{any}', 'Api\ApiWorkers@delete');