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
//文章
Route::get('/articles','ArticleController@index')->name('articles.index');
Route::get('/articles/{id}','ArticleController@edit')->name('articles.edit');
Route::get('/articles/create','ArticleController@create')->name('articles.create');

//文章Api
Route::get('/api/articles','Api\ArticleController@index')->name('api.articles.index');
Route::get('/api/articles/{id}','Api\ArticleController@show')->name('api.articles.show');
Route::delete('/api/articles/{id}','Api\ArticleController@destroy')->name('api.articles.destroy');
Route::put('/api/articles/{id}','Api\ArticleController@update')->name('api.articles.update');
Route::post('/api/articles','Api\ArticleController@store')->name('api.articles.store');

