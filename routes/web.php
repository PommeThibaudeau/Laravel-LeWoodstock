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
 * AUTHENTIFICATION
 */
Auth::routes();

/**
 * USERS
 */
Route::get('/home', 'HomeController@index')->name('home');

