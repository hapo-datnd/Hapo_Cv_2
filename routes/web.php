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

Route::prefix('/admins')->group(function () {
   Route::get('/','Admin\AdminController@index')->name('admins.index');

   Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin_login_form');
   Route::post('/login','Auth\AdminLoginController@login')->name('admin_login');

   Route::post('/logout','Auth\AdminLoginController@logout')->name('logout_admin');

   Route::get('/change_password/{id}','Admin\AdminController@getChangePassword')->name('admin.change_password');
   Route::patch('/change_password/{id}','Admin\AdminController@patchChangePassword')->name('update_password_admin');

   Route::get('/admin','Admin\AdminController@indexAdmin')->name('admin_index');
   Route::get('/admin/search','Admin\AdminController@search')->name('admins.search');
});

Route::resource('admins','Admin\AdminController');

Route::resource('users','User\UserController');

Route::resource('cvs','Cv\CvController');

Route::prefix('/users')->group(function () {
    Route::get('/change_password/{id}','User\UserController@getChangePassword')->name('user.change_password');
    Route::patch('/change_password/{id}','User\UserController@patchChangePassword')->name('update_password_user');
});

Route::prefix('/cvs')->group(function () {
    Route::patch('/update_status/{id}','Cv\CvController@updateStatus')->name('cvs.update_status');
});
