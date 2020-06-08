<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('reserves', 'Api\v1\ReserveController@list');
Route::get('reserves/{id}', 'Api\v1\ReserveController@getById');
Route::post('reserves', 'Api\v1\ReserveController@create');
Route::put('reserves/{id}', 'Api\v1\ReserveController@update');
Route::delete('reserves/{id}', 'Api\v1\ReserveController@delete');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
