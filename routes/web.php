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

// TDD -> TEST DRIVEN DEVELOPMENT

Route::get('/tasks','TasksController@index');
Route::post('/tasks','TasksController@store');
Route::delete('/tasks/{id}','TasksController@destroy');
Route::put('/tasks/{id}','TasksController@update');
Route::put('/tasks','TasksController@complete');

//Route::get('/task_edit',function(){
//    return view('about');
//});

Route::get('/task_edit/{id}','TasksController@edit');
//Route::get('/tasks',function() {
//    return view ('tasks');
//});

Route::get('/about',function(){
    return view('/about');
});

Route::view('/contact','contact');

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/prova','ProvaController@show');
Route::get('/prova',function(){
   $prova = "asdasd";
    dd($prova);
});

Route::redirect('/hola','/prova');

////COmplete
//Route::post('/completed_task','CompletedTaskController@store');
//
////uncomplete
//Route::delete('/uncompleted_task','CompletedTaskController@destroy');
