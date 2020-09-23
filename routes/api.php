<?php

use Illuminate\Http\Request;

Route::apiResource('books', 'BookController');

Route::post('/user/login', 'api\AuthController@login');
Route::post('/user/register', 'api\AuthController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
