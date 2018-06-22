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

/**
 * ROOT
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * ADMIN
 */
Route::group(['middleware' => ['auth']], function(){
    // Articles
    Route::get('/articles/edit/{id}', 'ArticleController@edit')->name('articles.edit');
    Route::get('/articles/create', 'ArticleController@create')->name('articles.create');
    Route::post('/articles', 'ArticleController@store')->name('articles.store');
    Route::put('/articles/{id}', 'ArticleController@update')->name('articles.update');
    Route::get('/articles/delete/{id}', 'ArticleController@destroy')->name('articles.delete');
    Route::delete('/articles/{id}', 'ArticleController@destroy')->name('articles.destroy');

    // Images
    Route::get('/images', 'ImageController@index')->name('images.index');
    Route::get('/images/{id}', 'ImageController@show')->name('images.show');

    // Types
    Route::get('/types/create', 'TypeController@create')->name('types.create');
    Route::post('/types', 'TypeController@store')->name('types.store');
    Route::get('/types/edit/{id}', 'TypeController@edit')->name('types.edit');
    Route::get('/types/delete/{id}', 'TypeController@destroy')->name('types.delete');
    Route::delete('/types/{id}', 'TypeController@destroy')->name('types.destroy');
    Route::put('/types/{id}', 'TypeController@update')->name('types.update');
    Route::get('/types/{id}', 'TypeController@show')->name('types.show');
    Route::get('/types', 'TypeController@index')->name('types.index');

    // Matters
    Route::get('/matieres/create', 'MatterController@create')->name('matters.create');
    Route::post('/matieres', 'MatterController@store')->name('matters.store');
    Route::get('/matieres/edit/{id}', 'MatterController@edit')->name('matters.edit');
    Route::get('/matieres/delete/{id}', 'MatterController@destroy')->name('matters.delete');
    Route::delete('/matieres/{id}', 'MatterController@destroy')->name('matters.destroy');
    Route::put('/matieres/{id}', 'MatterController@update')->name('matters.update');
    Route::get('/matieres/{id}', 'MatterController@show')->name('matters.show');
    Route::get('/matieres', 'MatterController@index')->name('matters.index');
});

/**
 * ARTICLES
 */
Route::get('/articles', 'ArticleController@index')->name('articles.index');
Route::get('/articles/{id}', 'ArticleController@show')->name('articles.show');

/**
 * AUTHENTIFICATION
 */
Auth::routes();

/**
 * USERS
 */
Route::get('/home', 'HomeController@index')->name('home');