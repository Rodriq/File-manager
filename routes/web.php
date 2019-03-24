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
Route::get('folder','FolderController@index')->name('folder');
Route::get('create', 'FolderController@create')->name('create');
Route::post('save', 'FolderController@save')->name('save');
Route::any('delete/{id}', 'FolderController@delete')->name('delete');
Route::get('rename/{id}', 'FolderController@rename')->name('rename');
Route::post('update/{id}', 'FolderController@update')->name('update');
Route::get('view/{id}', 'FolderController@view')->name('view');

Route::prefix('files')->name('files.')->middleware('auth')->group(function()
{
	Route::get('/index','FileController@index')->name('index');
	Route::post('/store/{id}', 'FileController@store')->name('store');
	Route::post('create/{id}', 'FileController@newFolder')->name('create');
	Route::post('/save', 'FileController@saveFolder')->name('save');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
