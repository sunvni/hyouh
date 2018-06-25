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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('project','ProjectController');

    Route::get('project/{project_id}/addtask','TaskController@create')->name('task.add');

    Route::post('task','TaskController@store')->name('task.store');

    Route::match(['put','patch'],'task/{task}','TaskController@update')->name('task.update');

    Route::delete('task/{task}','TaskController@destroy')->name('task.destroy');
    
    Route::get('task/{task}','TaskController@show')->name('task.show');

    Route::get('task/{task}/edit','TaskController@edit')->name('task.edit');
    
    Route::get('task/{task}/image/add','TaskController@addImage')->name('task.image.add');

    Route::post('task/{task}/image/','TaskController@storeImage')->name('task.image.store');

    Route::get('image/{image}/edit','TaskController@editImage')->name('task.image.edit');

    Route::post('image/{image}','TaskController@addNote')->name('task.image.addnote');
    
});