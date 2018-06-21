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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*** Type Routes ***/

Route::get('/types', 'Type\TypeController@index');
Route::get('/types/show/{id}', 'Type\TypeController@show');

Route::get('/types/create', 'Type\TypeController@create');
Route::post('/types/create', 'Type\TypeController@save');

Route::get('/types/update/{id}', 'Type\TypeController@update');
Route::post('/types/update/{id}', 'Type\TypeController@saveUpdate');
