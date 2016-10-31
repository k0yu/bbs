<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::resource('board', 'BoardController');
Route::resource('comment', 'CommentController');
Route::resource('tag', 'TagController');

Route::get('/home', 'HomeController@myHome');
Route::get('/home/{id}', 'HomeController@userHome');
Route::get('/home/comment', 'HomeController@myHomeComment');
Route::get('/home/comment/{id}', 'HomeController@userHomeComment');

Route::get('/search', 'SearchController@search');

