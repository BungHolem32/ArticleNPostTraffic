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
    Route::get('/create','ArticlesController@create')->name('article.create-get');
    Route::post('/create','ArticlesController@create')->name('article.create-post');
    Route::get('/edit/{articleID}', 'ArticlesController@edit')->name('articles.edit-view')->where('articleID', '[0-9]+');//Route::get('/articles/create/{author}','ArticleController@createFromAuthor')->name('articles.create-from-author');
    Route::put('/edit/{articleID}', 'ArticlesController@edit')->name('articles.edit-post')->where('articleID', '[0-9]+');
    Route::delete('/delete/{articleID}', 'ArticlesController@deleteArticle')->name('articles.delete')->where('articleID', '[0-9]+');
//  Route::get('/create/{author}','ArticleController@createFromAuthor')->name('articles.create-from-author');

});

//i have done it the hard way
//there's another way to do it with the larval generator
// i know the i need to use all the http request but there was some bug that i didn't manage to fix until now

