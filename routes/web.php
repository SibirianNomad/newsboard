<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Announcement\AnnouncementController;

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

//announcement rest API
Route::group(['namespace'=>'Announcement','prefix'=>'/'], function(){
    Route::resource('/announcement','AnnouncementController')->names('announcement');
});
//get user announcements
Route::get('/announcements/{id}',[AnnouncementController::class, 'user_announcements'])->middleware('auth');

//profile page
Route::group(['namespace'=>'User','prefix'=>'/'], function(){
    Route::resource('/profile','UserController')
        ->only(['index','update','destroy'])
        ->middleware('auth')
        ->names('profile');
});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

