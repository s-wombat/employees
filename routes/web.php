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

Route::prefix('admin')
    ->middleware('admin')
    ->name('admin.')
    ->group(function (){
    Route::get('/tree', 'UserController@buildTree')->name('buildTree');
    Route::get('/sort', 'UserController@sort')->name('sort');
    Route::get('/filter', 'UserController@filter')->name('filter');
    Route::get('/{id}', 'UserController@showEditForm')->where('id', '[0-9]+')->name('edit');
    Route::get('/create', 'UserController@showCreateForm')->name('create');
    Route::delete('/{id}', 'UserController@remove')->name('remove');
    Route::post('/{id?}', 'UserController@store')->name('store');
});
