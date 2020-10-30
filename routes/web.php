<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
//Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Front')->name('front.')->group(function () {
	Route::get('/', 'PostController@index')->name('home');
	//Route::resource('/posts', 'PostController');
	Route::get('/posts', 'PostController@index')->name('posts.index');
	Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
	Route::get('/users/{user}', 'UserController@show')->name('users.show');
});

Auth::routes();


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource ('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
	Route::resource('/posts', 'PostController');
	Route::resource('/comments', 'CommentController');
	Route::get('/posts-active','PostController@activePosts') ->name('activeposts');
	Route::get('/posts-draft','PostController@draftPosts') ->name('draftposts');
});
