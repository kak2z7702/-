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


Route::get('/', 'IndexController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('post/{post}', 'IndexController@viewPost')->name('post.view');
Route::get('category/{category}', 'IndexController@viewCategory')->name('category.view');

Auth::routes();

//test task routes
Route::middleware(['auth'])->prefix('manage')->namespace('Manage')->group(function () {
    Route::get('', 'IndexController@index')->name('manage');

    //Post routes
    Route::prefix('post')->group(function () {
        Route::get('datatables', 'IndexController@indexPostDataTables')->name('post.datatables');

        Route::get('create', 'PostController@create')->name('post.create');
        Route::post('store', 'PostController@store')->name('post.store');

        Route::get('{post}/edit', 'PostController@edit')->name('post.edit');
        Route::post('{post}/update', 'PostController@update')->name('post.update');

        Route::middleware(['ajax'])->post('delete', 'PostController@delete')->name('post.delete');
    });

    //Category routes
    Route::prefix('category')->group(function () {
        Route::get('datatables', 'IndexController@indexCategoryDataTables')->name('category.datatables');

        Route::get('create', 'CategoryController@create')->name('category.create');
        Route::post('store', 'CategoryController@store')->name('category.store');

        Route::get('{category}/edit', 'CategoryController@edit')->name('category.edit');
        Route::post('{category}/update', 'CategoryController@update')->name('category.update');

        Route::middleware(['ajax'])->post('delete', 'CategoryController@delete')->name('category.delete');

    });
});

