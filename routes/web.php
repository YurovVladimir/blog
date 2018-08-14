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
Route::get('/test', 'TestController@helloWorld');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/factorial', 'TestController@fact')->name('factorial');
Route::get('/validate', 'TestController@notString')->name('not_string');
Route::resource('posts', 'PostController');
Route::resource('comments', 'CommentController', ['only' => [
    'store', 'update', 'destroy',
]]);
Route::get('/img', 'TestController@image')->name('image');
