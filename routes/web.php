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

Route::get('/tasks','TasksController@index');
Route::post('/tasks','TasksController@store');
Route::delete('/tasks/{id}','TasksController@destroy');
Route::put('/tasks/{id}','TasksController@update');
Route::get('/task_edit/{id}','TasksController@edit');

Route::get('/about',function(){
    return view('/about');
});

Route::view('/contact','contact');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks_vue','TasksVueController@index');

Route::put('/tasks-completed/{id}','TasksCompletedController@store');
Route::delete('/tasks-uncompleted/{id}','TasksCompletedController@destroy');