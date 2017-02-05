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


Route::get('/', 'InitController@index')->name('articles.generate');

Route::group(['prefix'=>'articles'],function (){

    Route::get('/','ArticlesController@index')->name('articles.index');
    Route::get('/delete/{article}', 'ArticlesController@deleteArticle')->name('articles.delete')->where('article', '[0-9]+');
    Route::get('/edit/article={article}', 'ArticlesController@editView')->name('articles.edit-view')->where('article', '[0-9]+');//Route::get('/articles/create/{author}','ArticleController@createFromAuthor')->name('articles.create-from-author');
    Route::get('/edit/{article}/commit', 'ArticlesController@editArticle')->name('articles.edit-post')->where('article', '[0-9]+');
    Route::get('/create/{author}','ArticleController@createFromAuthor')->name('articles.create-from-author');
    Route::get('/create','ArticlesController@create')->name('article.create-get');
    Route::post('/create','ArticlesController@create')->name('article.create-post');

});

//i have done it the hard way
//there's another way to do it with the larval generator
// i know the i need to use all the http request but there was some bug that i didn't manage to fix until now

