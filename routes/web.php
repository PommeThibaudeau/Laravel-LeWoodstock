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
    Route::get('/articles/create', 'ArticleController@create')->name('articles.create');
    Route::post('/articles/store', 'ArticleController@store')->name('articles.store');
    Route::get('/articles/edit/{id}', 'ArticleController@edit')->name('articles.edit');
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

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});

/**
 * CONTACT FORM
 */
Route::get('contacts', 'ContactController@create')->name('contacts.create');
Route::post('contacts', 'ContactController@store')->name('contacts.store');

/**
 * ARTICLES
 */
Route::get('/articles', 'ArticleController@index')->name('articles.index');
Route::post('/articles', 'ArticleController@index')->name('articles.filter');
Route::get('/articles/{id}', 'ArticleController@show')->name('articles.show');

/**
 * AUTHENTIFICATION
 */
// Authentication Routes...
Route::get('adminConnection', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('adminConnection', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/**
 * USERS
 */
Route::get('/home', 'HomeController@index')->name('home');