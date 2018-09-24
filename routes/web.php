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

Route::post('posts/{post}/likes', 'PostController@like')->middleware('auth');
Route::get('posts/{post}/likes', 'PostController@getLikes');
Route::resource('posts', 'PostController');

Route::post('comments/{comment}/likes', 'CommentController@like')->middleware('auth');
Route::get('comments/{comment}/likes', 'CommentController@getLikes');
Route::resource('comments', 'CommentController', ['only' => [
    'store', 'update', 'destroy',
]]);

Route::resource('users', 'UserController');

Route::get('/img', 'TestController@image')->name('image');

Route::prefix('make_consult')->group(function (){
    Route::get('king', 'MakeConsultController@distribute')->name('king');
    Route::get('smile', 'MakeConsultController@smile');
    Route::get('atmosphere', 'MakeConsultController@atmosphere');
    Route::post('upload_file', 'MakeConsultController@uploadFile')->name('uploadFile');
});

Route::get('login/{driver}', 'LoginController@redirectToProvider')->name('social_login');
Route::get('login/{driver}/callback', 'LoginController@handleProviderCallback');