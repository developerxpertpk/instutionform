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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('project_index');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/user_register','CustomregisterController@insert')->name('user.register');

Route::get('/login_form','CustomregisterController@showloginform')->name('show.login');

Route::get('/login', 'Auth\loginController@showLoginform')->name('login');
Route::post('submit','Auth\LoginController@login')->name('login.submit');

				// Admin Routes
Route::prefix('/admin')->group(function(){

	Route::get('login', 'Auth\loginController@showLoginform')->name('admin.login');
	Route::post('submit','Auth\LoginController@login')->name('login.submit');
	Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');
	Route::get('charts','DashboardController@chart')->name('charts');
	Route::resource('user','UserController');
	Route::post('user/update/{id}','UserController@status_update')->name('user.update1');
});

//Route::resource('itemCRUD','DashboardController');
 
//  /***   Password reset password ****/

// Route::prefix('/password')->group(function(){

// Route::get('/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

// Route::post('/reset','Auth\ResetPasswordController@reset')->name('reset');

// });

// Route::get('password/reset/{token?}','Auth\PasswordController@ahowResetForm');
// Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
// Route::get('auth/logout',['as'=>'logout','uses'=>'Auth\PasswordController@sendResetLinkEmail']);


// Route::get('auth/password/reset','Auth\PasswordController@getResetAuthenticatedView');

// Route::post('auth/password/reset', 'Auth\PasswordController@resetAuthenticated');
Auth::routes();