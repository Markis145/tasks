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

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\LoggedUserAvatarController;
use App\Http\Controllers\LoggedUserPhotoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Task;

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

    Route::get('/profile', '\\'. ProfileController::class . '@show');
    Route::post('/photo', '\\'. PhotoController::class . '@store');
    Route::get('/user/photo', '\\'. LoggedUserPhotoController::class . '@show');

    Route::post('/avatar', '\\'. AvatarController::class . '@store');
    Route::get('/user/avatar', '\\'. LoggedUserAvatarController::class . '@show');

    Route::get('/changelog','\\'. ChangelogController::class . '@index');
    Route::get('/notifications', '\\' . NotificationController::class . '@index');

});



Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/omplir', function () {
    for($i = 1; $i <= 10000; $i++) {
        Task::create([
            'name' => 'Prova'
        ]);
    }
});
