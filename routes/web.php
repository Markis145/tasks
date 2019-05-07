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
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\LoggedUserAvatarController;
use App\Http\Controllers\LoggedUserPhotoController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\NewslettersController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PushSubscriptionController;
use App\Http\Controllers\TasquesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VerifyMobileController;
use App\Task;

Auth::routes(['verify' => true]);

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

    Route::get('/features','\\'. FeaturesController::class . '@index');

    Route::get('/newsletters', '\\' . NewslettersController::class . '@index');

    Route::get('/clock', '\\' . ClockController::class . '@index');

    Route::get('/tasques/{id}', '\\' . TasquesController::class . '@show');

    Route::get('/chat', '\\' . ChatController::class . '@index');
    Route::get('/xat', '\\' . ChatController::class . '@index');

    Route::get('/users', '\\' . UsersController::class . '@index');

    Route::get('/games', '\\' . GamesController::class . '@index');

    Route::post('/subscriptions', '\\' . PushSubscriptionController::class . '@update');
    Route::post('/subscriptions/Delete', '\\' . PushSubscriptionController::class . '@destroy');

    Route::get('/multimedia', '\\' . MultimediaController::class . '@index');

    Route::get('/verificar_mobil','\\' . VerifyMobileController::class . '@index');
    Route::post('/verificar_mobil','\\' . VerifyMobileController::class . '@send');

});

Route::get('/', function () {
    return view('welcome');
});


Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/omplir', function () {
    for($i = 1; $i <= 10000; $i++) {
        Task::create([
            'name' => 'Prova'
        ]);
    }
});
