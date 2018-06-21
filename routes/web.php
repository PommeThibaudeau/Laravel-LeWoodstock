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
