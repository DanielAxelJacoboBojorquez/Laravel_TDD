<?php

use Illuminate\Support\Facades\Route;

Route::post('/posts', 'PostController@store');
Route::get('/posts', 'PostController@index');
Route::get('/posts/{post}', 'PostController@show');
