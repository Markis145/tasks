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

Auth::routes();
//Auth::logout();

//TODO
Route::post('/login_alt','Auth\LoginAltController@login');
Route::post('/register_alt','Auth\RegisterAltController@register');

// MIDDLEWARE

Route::middleware(['auth'])->group(function (){
    Route::get('/tasks','TasksController@index');
    Route::post('/tasks','TasksController@store');
    Route::delete('/tasks/{id}','TasksController@destroy');
    Route::put('/tasks/{id}','TasksController@update');
    Route::get('/task_edit/{id}','TasksController@edit');

    Route::get('/about',function(){
        return view('/about');
    });

    Route::view('/contact','contact');

    Route::post('/completed_task/{task}','TasksCompletedController@store');
    Route::delete('/completed_task/{task}','TasksCompletedController@destroy');

    Route::get('/tasks_vue','TasksVueController@index');
    Route::get('/tasques','TasquesController@index');
    Route::get('/home','TasquesController@index');

    Route::get('/user/tasks','LoggedUserTasksController@index');

    Route::impersonate();

    //Tasques
    Route::get('/tags','TagsController@index');
});



Route::get('/', function () {
    return view('welcome');
});



