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

    // Types
    Route::get('/types/create', 'TypeController@create')->name('types.create');
    Route::post('/types', 'TypeController@store')->name('types.store');
    Route::get('/types/edit/{id}', 'TypeController@edit')->name('types.edit');
    Route::delete('/types/{id}', 'TypeController@destroy')->name('types.destroy');
    Route::put('/types/{id}', 'TypeController@update')->name('types.update');
});

/**
 * TYPES
 */
Route::get('/types/{id}', 'TypeController@show')->name('types.show');
Route::get('/types', 'TypeController@index')->name('types.index');

/**
 * AUTHENTIFICATION
 */
Auth::routes();

/**
 * USERS
 */
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){
  // article
  Route::get('create', 'ArticleController@create');
  Route::post('create', 'ArticleController@store');

  Route::get('/articles', function () {
      $articles = \App\Article::all();
      return view('/home', ['articles' => $articles]);
  });
  Route::get('/articles/{id?}', function ($id="") {
      $article = \App\Article::findOrFail($id);
      return view('/show', ['article' => $article]);
  });
});
