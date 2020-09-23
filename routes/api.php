<?php

use Illuminate\Http\Request;

Route::apiResource('books', 'BookController');

Route::post('/user/login', 'api\AuthController@login');
Route::post('/user/register', 'api\AuthController@register');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user/authors', 'api\AuthController@authors');
});
