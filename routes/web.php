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

Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::get('/profile', 'user\UserController@profile')->name('user.profile');

Route::get('/changePassword', 'user\UserController@showChangePasswordForm');

Route::post('/changePassword', 'user\UserController@changePassword')->name('user.changePassword');

Route::get('/edit', 'user\UserController@edit')->name('user.profile.edit');

Route::patch('/update', 'user\UserController@update')->name('user.profile.update');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/showtask/{task}', 'HomeController@showTask')->name('showtask');
Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'admin\AdminController@index')->name('admin');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/executed/all', 'admin\TaskController@executedAll')->name('task.executed.all');
    Route::get('/executed', 'admin\TaskController@executed')->name('task.executed');
    Route::get('/task/filtration', 'admin\TaskController@filtration')->name('task.filtration');
    Route::resource('/user', 'admin\UserController');
    Route::resource('/task', 'admin\TaskController');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});
