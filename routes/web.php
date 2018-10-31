<?php

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

Route::get('/', 'welcomeController@index');
Route::post('/create', 'welcomeController@create');
Route::delete('/{id}', 'welcomeController@delete');
Route::get('/datalist', 'welcomeController@studentlist');
Route::post('/{id}', 'welcomeController@updateID');
Route::put('/update/{id}', 'welcomeController@update');