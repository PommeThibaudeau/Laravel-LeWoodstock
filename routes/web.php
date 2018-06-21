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
    Route::delete('/articles/{id}', 'ArticleController@destroy')->name('articles.destroy');

    // Images
    Route::get('/images/edit/{id}', 'ImageController@edit')->name('images.edit');
    Route::get('/images/create', 'ImageController@create')->name('images.create');
    Route::post('/images', 'ImageController@store')->name('images.store');
    Route::put('/images/{id}', 'ImageController@update')->name('images.update');
    Route::delete('/images/{id}', 'ImageController@destroy')->name('images.destroy');
    Route::get('/images', 'ImageController@index')->name('images.index');
    
    // Types
    Route::get('/types/create', 'TypeController@create')->name('types.create');
    Route::post('/types', 'TypeController@store')->name('types.store');
    Route::get('/types/edit/{id}', 'TypeController@edit')->name('types.edit');
    Route::delete('/types/{id}', 'TypeController@destroy')->name('types.destroy');
    Route::put('/types/{id}', 'TypeController@update')->name('types.update');

    // Matters
    Route::get('/matters/create', 'MatterController@create')->name('matters.create');
    Route::post('/matters', 'MatterController@store')->name('matters.store');
    Route::get('/matters/edit/{id}', 'MatterController@edit')->name('matters.edit');
    Route::delete('/matters/{id}', 'MatterController@destroy')->name('matters.destroy');
    Route::put('/matters/{id}', 'MatterController@update')->name('matters.update');
});

/**
 * ARTICLES
 */
Route::get('/articles', 'ArticleController@index')->name('articles.index');
Route::get('/articles/{id}', 'ArticleController@show')->name('articles.show');

/**
 * IMAGES
 */
Route::get('/images/{id}', 'ImageController@show')->name('images.show');

/**
 * TYPES
 */
Route::get('/types/{id}', 'TypeController@show')->name('types.show');
Route::get('/types', 'TypeController@index')->name('types.index');

/**
 * MATTERS
 */
Route::get('/matters/{id}', 'MatterController@show')->name('matters.show');
Route::get('/matters', 'MatterController@index')->name('matters.index');

/**
 * AUTHENTIFICATION
 */
Auth::routes();

/**
 * USERS
 */
Route::get('/home', 'HomeController@index')->name('home');

